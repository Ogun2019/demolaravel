<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AchatDetails extends Model {

    protected $fillable = [
        'num', 'fournisseur_id_fk', 'intitule_action', 'numero_semaine','date_debut',
        'date_fin','epuisement','valable_fr','valable_be','valable_lux','valable_lux','valable_ch',
        'valable_It','presence_cat','num_page_cat','details_action','offre','remise','intervention',
        'plv_fournisseur','commentaire','detail_plv_fournisseur','f1','f2','f3','f4',
        'quantite_plv','date_livraison_logitoys','commentaire_plv','contact_plv'
    ];

}
