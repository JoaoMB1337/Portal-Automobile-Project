<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Tem certeza que deseja excluir os veículos selecionados?</p>
        <div class="modal-actions">
            <button id="confirmDelete" class="confirm-button">Excluir</button>
            <button id="cancelDelete" class="cancel-button">Cancelar</button>
        </div>
    </div>
</div>
@csrf

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        text-align: center;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-actions {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
    }

    .confirm-button,
    .cancel-button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    .confirm-button {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .cancel-button {
        background-color: #6c757d;
        color: white;
        border: none;
    }
</style>