<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="list-body">
        <div class="list-body-content">
            <div class="list-body-top">
                <div class="list-category-title">
                    <h3 class="list-title">Pagamentos</h3>
                </div>
                <div class="list-category-sub-title">
                    <p class="list-sub-title">Historico de pagamentos de <?php echo htmlspecialchars( $partner, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                </div>
            </div>
            <div class="list-body-middle">
                <form action="">
                    <div class="list-search-top">
                        <div class="search-dropdown-body">
                            <div class="dropdown-box">
                                <select name="type" id="type">
                                    <?php if( $tipo=='payment_payer' ){ ?>
                                    <option value="payment_payer" selected>NOME DO PAGADOR</option>
                                    <?php }else{ ?>
                                    <option value="payment_payer">NOME DO PAGADOR</option>
                                    <?php } ?>

                                    <?php if( $tipo=='payment_status' ){ ?>
                                    <option value="payment_status" selected>SITUAÇÃO DO PAGAMENTO</option>
                                    <?php }else{ ?>
                                    <option value="payment_status">SITUAÇÃO DO PAGAMENTO</option>
                                    <?php } ?>

                                    <?php if( $tipo=='payment_dtregister' ){ ?>
                                    <option value="payment_dtregister" selected>DATA DO PAGAMENTO</option>
                                    <?php }else{ ?>
                                    <option value="payment_dtregister">DATA DO PAGAMENTO</option>
                                    <?php } ?>
                              </select>
                            </div>
                        </div>

                        <div class="search-quantity-body">
                            <div class="dropdown-box">
                                <select name="quantity" id="quantity">
                                <option value="10">10 Itens</option>
                                <option value="20">20 Itens</option>
                                <option value="30">30 Itens</option>
                                <option value="50">50 Itens</option>
                                <option value="100">100 Itens</option>
                              </select>
                            </div>
                        </div>

                        <div class="search-mode-body">
                            <div class="dropdown-box">
                                <select name="mode" id="mode">
                                <option value="ASC">CRESCENTE</option>
                                <option value="DESC">DECRESCENTE</option>
                              </select>
                            </div>
                        </div>

                        <div class="search-field-body">
                            <div class="search-input-group">
                                <div class="input-text">
                                    <input type="text" name="term" id="term" class="search-text-input" aria-label="VALOR">
                                    <button class="search-btn"><span>Buscar</span><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="list-table-body ">
                    <table>
                        <thead>
                            <th style="font-weight: bold; ">#</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Ação</th>
                        </thead>
                        <tbody>
                            <?php $counter1=-1;  if( isset($payments) && ( is_array($payments) || $payments instanceof Traversable ) && sizeof($payments) ) foreach( $payments as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td style="font-weight: bolder;"><?php echo htmlspecialchars( $value1["payment_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <?php if( $value1["payment_status"] == 'PAGO' ){ ?>
                                <td style="color: rgb(66, 230, 66);"><?php echo htmlspecialchars( $value1["payment_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <?php }else{ ?>
                                <td style="color: rgb(235, 71, 65);"><?php echo htmlspecialchars( $value1["payment_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <?php } ?>
                                <td><?php echo htmlspecialchars( $value1["payment_dtregister"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td>
                                    <a href="/admin/payment/profile<?php echo htmlspecialchars( $value1["payment_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?> " class="small-action-btn ">👁</a>
                                    <a href="/admin/payment/profile<?php echo htmlspecialchars( $value1["payment_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?> " class="action-btn ">Visualizar</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="list-body-bottom ">
                <div class="paginator-body ">
                    <div class="paginator-items ">
                        <?php $counter1=-1;  if( isset($pages ) && ( is_array($pages ) || $pages  instanceof Traversable ) && sizeof($pages ) ) foreach( $pages  as $key1 => $value1 ){ $counter1++; ?>
                        <div class="paginator-element ">
                            <a href="<?php echo htmlspecialchars( $value1["link"], ENT_COMPAT, 'UTF-8', FALSE ); ?> " class="paginator-target "><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="_js/jquery-3.6.0.min.js "></script>
<script src="_js/index.js "></script>

</html>