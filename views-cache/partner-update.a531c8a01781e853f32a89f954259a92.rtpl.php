<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="register-box">
        <div class="title-box">
            <h3>Atualizar condutor</h3>
        </div>
        <div class="content-box">
            <form method="post" action="/admin/conductor/update<?php echo htmlspecialchars( $condutor["conductor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-group" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="conductor_name" class="label-input">Nome completo <span class="mandatory">*</span></label>
                    <input type="text" class="text-input" id="conductor_name" name="conductor_name" value="<?php echo htmlspecialchars( $condutor["conductor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="conductor_identity" class="label-input">Identidade</label>
                    <input type="text" class="text-input" id="conductor_identity" name="conductor_identity" value="<?php echo htmlspecialchars( $condutor["conductor_identity"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="conductor_phone" class="label-input">Telefone</label>
                    <input type="text" class="text-input telefone" id="conductor_phone" name="conductor_phone" value="<?php echo htmlspecialchars( $condutor["conductor_phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="conductor_cpf" class="label-input">CPF</label>
                    <input type="text" class="text-input cpf" id="conductor_cpf" name="conductor_cpf" value="<?php echo htmlspecialchars( $condutor["conductor_cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="conductor_age" class="label-input">Idade <span class="mandatory">*</span></label>
                    <input type="text" class="text-input" id="conductor_age" name="conductor_age" value="<?php echo htmlspecialchars( $condutor["conductor_age"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="conductor_schooling" class="label-input">Escolaridade</label>
                    <input type="text" class="text-input" id="conductor_schooling" name="conductor_schooling" value="<?php echo htmlspecialchars( $condutor["conductor_schooling"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="conductor_note" class="label-input">Observação</label>
                    <input type="text" class="text-input" id="conductor_note" name="conductor_note" value="<?php echo htmlspecialchars( $condutor["conductor_note"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>

                <div class="input-check-group">
                    <span class="title-check">Possui algum beneficio ?</span>
                    <div class="check-row">
                        <div class="check-item">
                            <label class="check-container">
                                <div class="check-legend">
                                    SIM
                                </div>
                                <input class="checkbox-single toggle-input" type="checkbox" name="yes"
                                    onclick="toggleCheck(this)" <?php if( $condutor["conductor_socialbenefit"] ){ ?>checked<?php }else{ ?><?php } ?>>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="check-item">
                            <label class="check-container">
                                <div class="check-legend">
                                    NÃO
                                </div>
                                <input class="checkbox-single" type="checkbox" name="no"
                                    onclick="toggleCheck(this)" <?php if( $condutor["conductor_socialbenefit"] ){ ?><?php }else{ ?>checked<?php } ?>>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="benefit" class="label-input">Qual?</label>
                        <input type="text" id="others" class="check-input text-input" name="benefit" value="<?php echo htmlspecialchars( $condutor["conductor_socialbenefit"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    </div>
                </div>


                <div class="input-group">
                    <label for="conductor_familyincome" class="label-input">Renda familiar</label>
                    <input type="text" class="text-input renda" id="conductor_familyincome" name="conductor_familyincome" value="<?php echo htmlspecialchars( $condutor["conductor_familyincome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>

                <div class='input-wrapper'>
                    <img class="input-preview" src="<?php echo htmlspecialchars( $condutor["conductor_profilepicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                    <label for='input-file'>
                        <?php if( $condutor["conductor_profilepicture"] ){ ?>
                        <?php echo htmlspecialchars( $condutor["conductor_profilepicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                        <?php }else{ ?>
                        Selecione uma foto de perfil
                        <?php } ?>
                    </label>
                    <input id='input-file' type='file' value='<?php echo htmlspecialchars( $condutor["conductor_profilepicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>' name="conductor_profilepicture" onchange="photoPreview(event)" />
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