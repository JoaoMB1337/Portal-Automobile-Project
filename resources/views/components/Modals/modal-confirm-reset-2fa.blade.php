<div class="modal fade" id="confirmReset2FAModal" tabindex="-1" aria-labelledby="confirmReset2FALabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmReset2FALabel">Confirmar Reset 2FA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja resetar a autenticação de dois fatores para este funcionário?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('reset2fa-form').submit();">Confirmar</button>
            </div>
        </div>
    </div>
</div>
