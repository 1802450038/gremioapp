<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="register-box">
        <div class="title-box">
            <h3>Atualizar Socio</h3>
        </div>
        <div class="content-box">
            <form method="post" action="/admin/partner/update<?php echo htmlspecialchars( $socio["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="form-group"
                enctype="multipart/form-data">
                <div class="input-group">
                    <label for="partner_fullname" class="label-input">Nome completo <span
                            class="mandatory">*</span></label>
                    <input type="text" class="text-input" id="partner_fullname" name="partner_fullname"
                        value="<?php echo htmlspecialchars( $socio["partner_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="partner_cpf" class="label-input">CPF</label>
                    <input type="text" class="text-input cpf" id="partner_cpf" name="partner_cpf"
                        value="<?php echo htmlspecialchars( $socio["partner_cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="partner_identity" class="label-input">Identidade</label>
                    <input type="text" class="text-input" id="partner_identity" name="partner_identity"
                        value="<?php echo htmlspecialchars( $socio["partner_identity"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="partner_dtnasc" class="label-input">Data de nascimento</label>
                    <input type="date" class="text-input" id="partner_dtnasc" name="partner_dtnasc"
                        value="<?php echo htmlspecialchars( $socio["partner_dtnasc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="partner_resphone" class="label-input">Telefone Residencial</label>
                    <input type="text" class="text-input residencial" id="partner_resphone" name="partner_resphone"
                        value="<?php echo htmlspecialchars( $socio["partner_resphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="partner_mobphone" class="label-input">Telefone Celular</label>
                    <input type="text" class="text-input telefone" id="partner_mobphone" name="partner_mobphone"
                        value="<?php echo htmlspecialchars( $socio["partner_mobphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="partner_email" class="label-input">Email <span class="mandatory">*</span></label>
                    <input type="email" class="text-input" id="partner_email" name="partner_email"
                        value="<?php echo htmlspecialchars( $socio["partner_email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="partner_milorganization" class="label-input">Organização Militar <span
                            class="mandatory">*</span></label>
                    <input type="milorganization" class="text-input" id="partner_milorganization"
                        name="partner_milorganization" value="<?php echo htmlspecialchars( $socio["partner_milorganization"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>
                <div class="input-group">
                    <label for="partner_assoctype" class="label-input">Tipo de associação</label>
                    <select type="text" class="text-input" id="partner_assoctype" name="partner_assoctype"
                        value="<?php echo htmlspecialchars( $socio["partner_assoctype"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                        <option value="REMIDO" <?php if( $socio["partner_assoctype"]=='REMIDO' ){ ?>selected<?php } ?>>REMIDO
                        <option value="MILITAR COM DESCONTO EM FOLHA" <?php if( $socio["partner_assoctype"]=='MILITAR COM DESCONTO EM FOLHA' ){ ?>selected<?php } ?>>MILITAR COM DESCONTO EM FOLHA
                        <option value="MILITAR SEM DESCONTO EM FOLHA" <?php if( $socio["partner_assoctype"]=='MILITAR SEM DESCONTO EM FOLHA' ){ ?>selected<?php } ?>>MILITAR SEM DESCONTO EM FOLHA
                        <option value="CIVIL" <?php if( $socio["partner_assoctype"]=='CIVIL' ){ ?>selected<?php } ?>>CIVIL
                        <option value="PROFESSOR (APEMU)" <?php if( $socio["partner_assoctype"]=='PROFESSOR (APEMU)' ){ ?>selected<?php } ?>>PROFESSOR (APEMU)
                    </select>
                </div>
                <div class="input-group">
                    <label for="partner_dtassoc" class="label-input">Data de associação</label>
                    <input type="date" class="text-input" id="partner_dtassoc" name="partner_dtassoc"
                        value="<?php echo htmlspecialchars( $socio["partner_dtassoc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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