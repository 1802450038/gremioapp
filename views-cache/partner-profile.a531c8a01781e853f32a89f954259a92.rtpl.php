<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="profile-body">
        <div class="entity-profile-card">
            <div class="entity-profile-card-top card-category">

                <div class="entity-img">
                    <img src="" alt="" srcset="" style="display: none;">
                </div>

                <div class="entity-title">
                    <div class="entity-name">
                        <h3><?php echo htmlspecialchars( $socio["partner_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                    </div>
                    <div class="entity-sub-info">
                        <p><?php echo htmlspecialchars( $socio["partner_assoctype"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                    </div>
                </div>

            </div>

            <div class="entity-profile-card-middle card-category">
                <div class="entity-info sub-card-category">
                    <div class="card-category-title">
                        <h3>socio</h3>
                    </div>
                    <div class="info-items">

                        <div class="info-box">
                            <h3 class="info-title">Nome</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Tag</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_uniquetag"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Identidade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_identity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">CPF</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Idade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_age"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Celular</h3>
                            <h3 class="info-value phone-mask"><?php echo htmlspecialchars( $socio["partner_mobphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Residencial</h3>
                            <h3 class="info-value phone-mask"><?php echo htmlspecialchars( $socio["partner_resphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Tipo associação</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_assoctype"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Dia de pagamento</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_paymentday"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Valor mensalidade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_monthlypayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Status</h3>
                            <?php if( $socio["partner_status"] == 'EM DÉBITO' ){ ?>
                            <h3 class="info-value" style="color: rgb(235, 71, 65);"><?php echo htmlspecialchars( $socio["partner_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <?php }else{ ?>
                                <h3 class="info-value" style="color: rgb(66, 230, 66);"><?php echo htmlspecialchars( $socio["partner_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <?php } ?>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Data de registro</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_dtregister"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="entity-address sub-card-category">
                    <div class="card-category-title">
                        <h3>Endereço</h3>
                    </div>
                    <?php if( $endereco != false ){ ?>
                    <div class="info-items">

                        <div class="info-box">
                            <h3 class="info-title">Rua</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_road"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Numero</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_number"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Complemento</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_complement"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Bairro</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_district"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">CEP</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Cidade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_city"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Estado</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_state"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                    </div>
                    <br>
                    <div class="info-items">
                        <div class="new-element-action">
                            <a href="/admin/address/update<?php echo htmlspecialchars( $endereco["address_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button class="edit">Editar</button>
                            </a>
                        </div>
                        <div class="new-element-action">
                            <a href="/admin/address/delete<?php echo htmlspecialchars( $endereco["address_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                onclick="return confirm('Deseja realmente excluir este registro?')">
                                <button class="delete">Excluir</button>
                            </a>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <h3 style="padding-left: 30px; padding-bottom: 30px;">Nenhum endereço encontrado</h3>
                    <div class="new-element">
                        <a href="/admin/address/create<?php echo htmlspecialchars( $socio["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="new-element-button">
                            <button>
                                Incluir novo
                            </button>
                        </a>
                    </div>
                    <?php } ?>
                </div>

                <div class="entity-profile-bottom-depends sub-card-category">
                    <div class="card-category-title">
                        <h3>Dependentes</h3>
                    </div>
                    <?php if( $dependentes != false ){ ?>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="font-weight: bolder;">ID</th>
                                    <th>Nome</th>
                                    <th>Grau</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter1=-1;  if( isset($dependentes) && ( is_array($dependentes) || $dependentes instanceof Traversable ) && sizeof($dependentes) ) foreach( $dependentes as $key1 => $value1 ){ $counter1++; ?>
                                <tr>
                                    <td style="font-weight: bolder;"><?php echo htmlspecialchars( $value1["dependent_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["dependent_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["dependent_familiarity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td>
                                        <a href="/admin/dependent/profile<?php echo htmlspecialchars( $value1["dependent_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                            class="small-action-btn view"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }else{ ?>
                    <h3 style="padding-left: 30px; padding-bottom: 30px;">Nenhum familiar encontrado</h3>
                    <?php } ?>
                    <div class="new-element">
                        <a href="/admin/dependent/create<?php echo htmlspecialchars( $socio["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="new-element-button">
                            <button>
                                Incluir novo
                            </button>
                        </a>
                    </div>
                </div>

                <?php if( $socio["partner_monthlypayment"] != 'ISENTO' ){ ?>
                <div class="entity-profile-bottom-depends sub-card-category">
                    <div class="card-category-title">
                        <h3>Pagamentos</h3>
                    </div>
                    <?php if( $pagamentos != false ){ ?>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>SITUAÇÃO</th>
                                    <th>Data</th>
                                    <th>Vencimento</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter1=-1;  if( isset($pagamentos) && ( is_array($pagamentos) || $pagamentos instanceof Traversable ) && sizeof($pagamentos) ) foreach( $pagamentos as $key1 => $value1 ){ $counter1++; ?>
                                <tr>
                                    <?php if( $value1["payment_status"] == 'PAGO' ){ ?>
                                    <td style="color: rgb(66, 230, 66); font-weight: bold;"><?php echo htmlspecialchars( $value1["payment_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <?php }elseif( $value1["payment_status"] == 'ABERTO' ){ ?>
                                    <td style="color: rgb(250, 238, 68); font-weight: bold;"><?php echo htmlspecialchars( $value1["payment_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
                                    </td>
                                    <?php }else{ ?>
                                    <td style="color: rgb(235, 71, 65); font-weight: bold;"><?php echo htmlspecialchars( $value1["payment_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <?php } ?>
                                    <td><?php echo getDateForTemplate($value1["payment_dtregister"]); ?></td>
                                    <td><?php echo getDateForTemplate($value1["payment_duedate"]); ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="/admin/payment/profile<?php echo htmlspecialchars( $value1["payment_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                                class="small-action-btn view"><i class="fas fa-eye"></i></a>
                                            <?php if( $value1["payment_status"] !='PAGO' ){ ?>
                                            <a href="/admin/payment/pay<?php echo htmlspecialchars( $value1["payment_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                                class="small-action-btn pay"><i class="fas fa-dollar-sign"></i></a>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }else{ ?>
                    <h3 style="padding-left: 30px; padding-bottom: 30px;">Nenhum pagamento registrado</h3>
                    <?php } ?>
                    <div class="payment-actions">
                        <div class="new-payment">
                            <a href="/admin/payment/create<?php echo htmlspecialchars( $socio["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button class="edit payment-btn">
                                    Registrar novo
                                </button>
                            </a>
                        </div>
                        <?php if( $pagamentos != false ){ ?>
                        <div class="view-payment">
                            <a href="/admin/payments<?php echo htmlspecialchars( $socio["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button class="print payment-btn">
                                    Visualizar todos
                                </button>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
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
                            <a href="/admin/partner/update<?php echo htmlspecialchars( $socio["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button class="edit">Editar Sócio</button>
                            </a>
                        </div>
                        <div class="new-element-action">
                            <a href="/admin/partner/delete<?php echo htmlspecialchars( $socio["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                onclick="return confirm('Deseja realmente excluir este registro? Todos seus dependetes, endereço e cobranças serão excluidos')">
                                <button class="delete">Excluir Sócio</button>
                            </a>
                        </div>
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