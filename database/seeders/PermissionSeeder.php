<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['clientaddress_delete', 'Supprimer adresse client'],
            ['clientaddress_update', 'Mettre à jour adresse client'],
            ['clientaddress_create', 'Créer adresse client'],
            ['clientaddress_view', 'Voir adresse client'],
            ['clientcontact_delete', 'Supprimer contact client'],
            ['clientcontact_update', 'Mettre à jour contact client'],
            ['clientcontact_create', 'Créer contact client'],
            ['clientcontact_view', 'Voir contact client'],
            ['clientdocument_delete', 'Supprimer document client'],
            ['clientdocument_update', 'Mettre à jour document client'],
            ['clientdocument_create', 'Créer document client'],
            ['clientdocument_view', 'Voir document client'],
            ['clientnote_delete', 'Supprimer note client'],
            ['clientnote_update', 'Mettre à jour note client'],
            ['clientnote_create', 'Créer note client'],
            ['clientnote_view', 'Voir note client'],
            ['creditnote_delete', 'Supprimer avoir'],
            ['creditnote_update', 'Mettre à jour avoir'],
            ['creditnote_create', 'Créer avoir'],
            ['creditnote_view', 'Voir avoir'],
            ['intervention_delete', 'Supprimer intervention'],
            ['intervention_update', 'Mettre à jour intervention'],
            ['intervention_create', 'Créer intervention'],
            ['intervention_view', 'Voir intervention'],
            ['invoice_delete', 'Supprimer facture'],
            ['invoice_update', 'Mettre à jour facture'],
            ['invoice_create', 'Créer facture'],
            ['invoice_view', 'Voir facture'],
            ['payment_delete', 'Supprimer paiement'],
            ['payment_update', 'Mettre à jour paiement'],
            ['payment_create', 'Créer paiement'],
            ['payment_view', 'Voir paiement'],
            ['quote_delete', 'Supprimer devis'],
            ['quote_update', 'Mettre à jour devis'],
            ['quote_create', 'Créer devis'],
            ['quote_view', 'Voir devis'],
            ['task_delete', 'Supprimer tâche'],
            ['task_update', 'Mettre à jour tâche'],
            ['task_create', 'Créer tâche'],
            ['task_view', 'Voir tâche'],
            ['client_delete', 'Supprimer client'],
            ['client_update', 'Mettre à jour client'],
            ['client_create', 'Créer client'],
            ['client_view', 'Voir client'],
            ['company_view', 'Voir entreprise'],
            ['company_create', 'Créer entreprise'],
            ['company_update', 'Mettre à jour entreprise'],
            ['company_delete', 'Supprimer entreprise'],
            ['numerator_delete', 'Supprimer numérateur'],
            ['numerator_update', 'Mettre à jour numérateur'],
            ['numerator_create', 'Créer numérateur'],
            ['numerator_view', 'Voir numérateur'],
            ['supplier_view', 'Fournisseur peut voir'],
            ['supplier_create', 'Fournisseur peut créer'],
            ['supplier_update', 'Fournisseur peut modifier'],
            ['supplier_delete', 'Fournisseur peut supprimer'],
            ['article_view', 'Article peut voir'],
            ['article_create', 'Article peut créer'],
            ['article_update', 'Article peut modifier'],
            ['article_delete', 'Article peut supprimer'],
            ['permission_delete', 'Permission peut supprimer'],
            ['permission_update', 'Permission peut modifier'],
            ['permission_create', 'Permission peut créer'],
            ['permission_view', 'Permission peut voir'],
            ['role_delete', 'Role peut supprimer'],
            ['role_update', 'Role peut modifier'],
            ['role_create', 'Role peut créer'],
            ['role_view', 'Role peut voir'],
            ['user_delete', 'Utilisateur peut supprimer'],
            ['user_update', 'Utilisateur peut modifier'],
            ['user_create', 'Utilisateur peut créer'],
            ['user_view', 'Utilisateur peut voir'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => $permission[0],
                'd_name' => $permission[1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
