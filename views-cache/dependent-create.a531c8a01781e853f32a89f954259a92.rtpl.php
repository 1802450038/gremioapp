<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="row">
        <div class="register-box">
            <div class="title-box">
                <h3>Registrar Dependente</h3>
            </div>
            <div class="content-box">
                <form action="" method="post" class="form-group">
                    <div class="input-group">
                        <label for="dependent_fullname" class="label-input">Nome completo <span
                                class="mandatory">*</span></label>
                        <input type="text" class="text-input" id="dependent_fullname" name="dependent_fullname">
                    </div>
                    <div class="input-group">
                        <label for="dependent_identity" class="label-input">Identidade</label>
                        <input type="text" class="text-input" id="dependent_identity" name="dependent_identity">
                    </div>
                    <div class="input-group">
                        <label for="dependent_cpf" class="label-input">CPF</label>
                        <input type="text" class="text-input cpf" id="dependent_cpf" name="dependent_cpf">
                    </div>
                    <div class="input-group">
                        <label for="dependent_dtnasc" class="label-input">Data de nascimento <span
                                class="mandatory">*</span></label>
                        <input type="date" class="text-input" id="dependent_dtnasc" name="dependent_dtnasc">
                    </div>
                    <div class="input-group">
                        <label for="dependent_resphone" class="label-input">Telefone Residencial</label>
                        <input type="text" class="text-input residencial" id="dependent_resphone"
                            name="dependent_resphone">
                    </div>
                    <div class="input-group">
                        <label for="dependent_mobphone" class="label-input">Telefone Celular</label>
                        <input type="text" class="text-input telefone" id="dependent_mobphone"
                            name="dependent_mobphone">
                    </div>
                    <div class="input-group">
                        <label for="dependent_email" class="label-input">Email</label>
                        <input type="email" class="text-input" id="dependent_email" name="dependent_email">
                    </div>

                    <div class="input-group">
                        <label for="dependent_familiarity" class="label-input">Familiaridade <span
                                class="mandatory">*</span></label>
                        <input list="state-list" type="text" class="text-input" id="dependent_familiarity"
                            name="dependent_familiarity">
                        <datalist id="state-list">
                            <option value="CÔNJUGE">
                            <option value="FILHO/FILHA">
                            <option value="PAI/MÃE">
                        </datalist>
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