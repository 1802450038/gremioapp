<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="profile-body">
        <div class="entity-profile-card">
            <div class="entity-profile-card-top card-category">
                <div class="entity-img">

                </div>
                <div class="entity-title">
                    <div class="entity-name">
                        <h3><?php echo htmlspecialchars( $usuario["user_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                    </div>
                    <div class="entity-sub-info">
                        <p><?php echo htmlspecialchars( $usuario["user_sector"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                    </div>
                </div>
            </div>
            <div class="entity-profile-card-middle card-category">
                <div class="entity-info sub-card-category">
                    <div class="row card-category-title">
                        <h3 class="entity-info-title">Usuario</h3>
                    </div>
                    <div class="info-items">

                        <div class="info-box">
                            <h3 class="info-title">Nome completo</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $usuario["user_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Administrador</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $usuario["user_isadmin"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Setor</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $usuario["user_sector"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Cargo</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $usuario["user_office"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">E-Mail</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $usuario["user_email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Login</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $usuario["user_login"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Senha</h3>
                            <h3 class="info-value" style="margin-top: 20px;"><a href="/forgot" class="profile-action-bt" style="font-weight: bold; cursor: pointer; ">Trocar senha</a></h3>
                        </div>
                        <?php if( $administrador=='SIM' ){ ?>
                        <div class="info-box">
                            <h3 class="info-title">Data de registro</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $usuario["user_dtregister"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="entity-profile-card-bottom card-category">
                    <div class="entity-profile-bottom-actions sub-card-category">
                        <div class="card-category-title">
                            <h3>
                                Ações
                            </h3>
                        </div>
                        <div class="info-items">
                            <div class="new-element-action">
                                <a href="/admin/user/update<?php echo htmlspecialchars( $usuario["user_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    <button class="edit">Editar</button>
                                </a>
                            </div>
                            <?php if( $administrador=='SIM' ){ ?>
                            <div class="new-element-action">
                                <a href="/admin/user/delete<?php echo htmlspecialchars( $usuario["user_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onclick="return confirm('Deseja realmente excluir este registro?')">
                                    <button class="delete">Excluir</button>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </body>
    <script src="_js/jquery-3.6.0.min.js"></script>
    <script src="_js/index.js"></script>

    </html>