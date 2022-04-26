<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="row">
        <div class="register-box">
            <div class="title-box">
                <h3>Atualizar Dependente</h3>
            </div>
            <div class="content-box">
                <form action="" method="post" class="form-group">
                    <div class="input-group">
                        <label for="dependent_name" class="label-input">Nome completo <span class="mandatory">*</span></label>
                        <input type="text" class="text-input" id="dependent_name" name="dependent_name" value="<?php echo htmlspecialchars( $dependente["dependent_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="input-group">
                        <label for="dependent_identity" class="label-input">Identidade</label>
                        <input type="text" class="text-input" id="dependent_identity" name="dependent_identity" value="<?php echo htmlspecialchars( $dependente["dependent_identity"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="input-group">
                        <label for="dependent_cpf" class="label-input">CPF</label>
                        <input type="text" class="text-input cpf" id="dependent_cpf" name="dependent_cpf" value="<?php echo htmlspecialchars( $dependente["dependent_cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="input-group">
                        <label for="dependent_age" class="label-input">Idade <span class="mandatory">*</span></label>
                        <input type="text" class="text-input" id="dependent_age" name="dependent_age" value="<?php echo htmlspecialchars( $dependente["dependent_age"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="input-group">
                        <label for="dependent_phone" class="label-input">Telefone</label>
                        <input type="text" class="text-input telefone" id="dependent_phone" name="dependent_phone" value="<?php echo htmlspecialchars( $dependente["dependent_phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="input-group">
                        <label for="dependent_note" class="label-input">Observações</label>
                        <input type="text" class="text-input" id="dependent_note" name="dependent_note" value="<?php echo htmlspecialchars( $dependente["dependent_note"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="input-group">
                        <label for="dependent_schooling" class="label-input">Escolaridade</label>
                        <input type="text" class="text-input" id="dependent_schooling" name="dependent_schooling" value="<?php echo htmlspecialchars( $dependente["dependent_schooling"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                    <div class="input-check-group">
                        <span class="title-check">Familiaridade ? <span class="mandatory">*</span></span>
                        <div class="check-row">
                            <div class="check-item">
                                <label class="check-container">
                                    <div class="check-legend">
                                        cônjuge
                                    </div>
                                    <input class="checkbox-single" type="checkbox" name="conj" onclick="toggleFamiliarity(this)" <?php if( $familiaridade==='c' ){ ?>checked<?php } ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="check-item">
                                <label class="check-container">
                                    <div class="check-legend">
                                        filho/filha
                                    </div>
                                    <input class="checkbox-single" type="checkbox" name="chil" onclick="toggleFamiliarity(this)" <?php if( $familiaridade==='f' ){ ?>checked<?php } ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="check-item">
                                <label class="check-container">
                                    <div class="check-legend">
                                        pai/mãe
                                    </div>
                                    <input class="checkbox-single" type="checkbox" name="par" onclick="toggleFamiliarity(this)" <?php if( $familiaridade==='p' ){ ?>checked<?php } ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="check-item">
                                <label class="check-container">
                                    <div class="check-legend">
                                        OUTROS
                                    </div>
                                    <input  class="checkbox-single toggle-input" type="checkbox" name="other" onclick="toggleFamiliarity(this)" <?php if( $familiaridade==='o' ){ ?>checked<?php } ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="others" class="label-input">Outro motivo</label>
                            <input type="text" id="others" class="check-input text-input" name="others" <?php if( $familiaridade !='o' ){ ?>disabled<?php } ?> value="<?php echo htmlspecialchars( $dependente["dependent_familiarity"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        </div>
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