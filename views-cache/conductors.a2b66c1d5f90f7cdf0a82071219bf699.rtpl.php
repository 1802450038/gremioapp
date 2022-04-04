<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="list-body">
        <div class="list-body-content">
            <div class="list-body-top">
                <div class="list-category-title">
                    <h3 class="list-title">Condutores</h3>
                </div>
                <div class="list-category-sub-title">
                    <p class="list-sub-title">lista de condutores</p>
                </div>
            </div>
            <div class="list-body-middle">
                <form action="">
                    <div class="list-search-top">
                        <div class="search-dropdown-body">
                            <div class="dropdown-box">
                                <select name="type" id="type">
                                    <?php if( $tipo=='conductor_name' ){ ?>
                                    <option value="conductor_name" selected>Nome</option>
                                    <?php }else{ ?>
                                    <option value="conductor_name">Nome</option>
                                    <?php } ?>

                                    <?php if( $tipo=='conductor_uniquetag' ){ ?>
                                    <option value="conductor_uniquetag" selected>Identificador</option>
                                    <?php }else{ ?>
                                    <option value="conductor_uniquetag">Identificador</option>
                                    <?php } ?>
                                    <?php if( $tipo=='conductor_cpf' ){ ?>
                                    <option value="conductor_cpf" selected>CPF</option>
                                    <?php }else{ ?>
                                    <option value="conductor_cpf">CPF</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="search-field-body">
                            <div class="search-input-group">
                                <div class="input-text">
                                    <input type="text" class="search-text-input" placeholder="Termo da busca"
                                        id="term" name="term" value="<?php echo htmlspecialchars( $termo, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    <button class="search-btn"><span>Buscar</span><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="list-table-body">
                    <table>
                        <thead>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Ação</th>
                        </thead>
                        <tbody>
                            <?php $counter1=-1;  if( isset($condutores) && ( is_array($condutores) || $condutores instanceof Traversable ) && sizeof($condutores) ) foreach( $condutores as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td class="td-photo">
                                    <div class="table-photo"><img src="<?php echo htmlspecialchars( $value1["conductor_profilepicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt=""></div>
                                </td>
                                <td><?php echo htmlspecialchars( $value1["conductor_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td class="phone-mask"><?php echo htmlspecialchars( $value1["conductor_phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td>
                                    <a href="/admin/conductor/profile<?php echo htmlspecialchars( $value1["conductor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                        class="small-action-btn">👁</a>
                                    <a href="/admin/conductor/profile<?php echo htmlspecialchars( $value1["conductor_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                                        class="action-btn">Visualizar</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="new-element">
                    <a href="./conductor/create" class="new-element-button">
                        <button>
                            Incluir novo
                        </button>
                    </a>
                </div>
            </div>
            <div class="list-body-bottom">
                <div class="paginator-body">
                    <div class="paginator-items">
                        <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
                        <div class="paginator-element">
                            <a href="<?php echo htmlspecialchars( $value1["link"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="paginator-target"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
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