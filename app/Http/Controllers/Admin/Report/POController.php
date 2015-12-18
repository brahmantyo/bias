<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Database\po;
use Config;
class POController extends Controller
{
    /**
     * Get PO
     *
     * @return Response
     * @author Y.Brahmantyo A.K
     **/
    public function getIndex()
    {
        $po = \DB::select('SELECT 
    b.divisi,
    "" as nn,
    po.idpo,
    po.tglpo,
    dpo.plu,
    b.namadet nmbarang,
    dpo.hrg,
    dpo.qty,
    IF(b.satdefbeli="UNIT",b.sunit,
        IF(b.satdefbeli="PANJANG",b.spjg,b.sbrt)) satbeli,
    (dpo.hrg * dpo.qty) valpo,
    COUNT(beli.idbeli) realisasi,
    IF(b.satdefbeli="Unit",SUM(beli.qtyunit),
        IF(b.satdefbeli="Panjang",SUM(beli.qtypjg),
            IF(b.satdefbeli="Berat",SUM(beli.qtybrt),0))) qtybeli,
    IF(b.satdefbeli="Unit",SUM(beli.qtyunit),
        IF(b.satdefbeli="Panjang",(dpo.hrg*SUM(beli.qtypjg)),
            IF(b.satdefbeli="Berat",(dpo.hrg*SUM(beli.qtybrt)),0))) valbeli
FROM
    dpo
        INNER JOIN
    po ON po.idpo = dpo.idinduk AND po.status = 1
    left join
    mbarang b on b.plu=dpo.plu and b.idsup=po.idsupp and b.idbhn = po.bahan and b.idmotif = po.motif
        LEFT JOIN
    (SELECT 
        beli.idbeli,
            beli.idpo,
            dbeli.plu,
            SUM(dbeli.qtyunit) qtyunit,
            SUM(dbeli.qtypjg) qtypjg,
            SUM(dbeli.qtybrt) qtybrt,
            SUM(dbeli.hrgunit) hrgunit,
            SUM(dbeli.hrgpjg) hrgpjg,
            SUM(dbeli.hrgbrt) hrgbrt
    FROM
        beli
    INNER JOIN dbeli ON dbeli.idinduk = beli.idbeli
    WHERE
        beli.status = 1
    GROUP BY beli.idbeli , dbeli.plu) beli ON beli.idpo = po.idpo
        AND beli.plu = dpo.plu
GROUP BY po.idpo , dpo.plu
ORDER BY b.divisi,po.idpo');
        return view('admin.report.monitoringpo')->with('po',$po);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow($id)
    {
        $po = po::find(str_replace('-','/',$id));
        return view('admin.transaction.po-show')->with('po',$po);
    }
}
