<div class="modal fade overflow-hidden" id="confirmodal" tabindex="-1" aria-labelledby="confirmodalabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #005086">
                <h5 class="modal-title text-white fw-bold" id="confirmodalabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color:#318fb5;color:white;">
                <strong> Êtes-vous sûr de vouloir supprimer cet utilisateur ? </strong>
            </div>
            <div class="modal-footer"  style= "background-color: ">
                <form action="" method="POST">
                    <input type="hidden" id="modal_id" name="id_to_delete">
                    <button type="button" class="btn border-none" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-danger" name="confirm_delete">Supprimer</button>
                </form>    
            </div>    
        </div>
    </div>
</div>