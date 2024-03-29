<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="row">
        <div class="register-box">
            <div class="title-box">
                <h3>Registrar Pagamento</h3>
            </div>
            <div class="content-box">
                <form action="" method="post" class="form-group">
                    <div class="input-group">
                        <label for="partner_fullname" class="label-input">Nome Titular</label>
                        <input type="text" class="text-input" id="partner_fullname" name="partner_fullname" style="pointer-events: none;" value="<?php echo htmlspecialchars( $payment["partner_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="input-group">
                        <label for="payment_payer" class="label-input">Pagador</label>
                        <input type="text" class="text-input" id="payment_payer" name="payment_payer">
                    </div>
                    <div class="input-group">
                        <label for="payment_value" class="label-input">Valor</label>
                        <input type="text" class="text-input renda" id="payment_value" name="payment_value" value="<?php echo htmlspecialchars( $payment["payment_value"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="input-group">
                        <label for="payment_method" class="label-input">Metodo</label>
                        <input type="text" class="text-input" id="payment_method" name="payment_method">
                    </div>
                    <div class="input-group">
                        <label for="payment_note" class="label-input">Observação</label>
                        <input type="text" class="text-input" id="payment_note" name="payment_note">
                    </div>
                    <div class="form-mandatory">
                        <p><span class="mandatory">*</span> Campos obrigatorios</p>
                    </div>
                    <div class="form-action">
                        <button class="action-reset" type="reset">Cancelar</button>
                        <button class="action-submit" type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFamiliarity(receviedElement) {

        let checkboxes = document.querySelectorAll(".checkbox-single");
        checkboxes.forEach(element => {
            if (element != receviedElement) {
                element.checked = false

            }
            if (receviedElement != null) {
                let others = document.getElementById("others");
                if (receviedElement.className.includes("toggle-input")) {
                    others.disabled = false;
                } else {
                    others.disabled = true;
                }


            }

        });
    }
</script>