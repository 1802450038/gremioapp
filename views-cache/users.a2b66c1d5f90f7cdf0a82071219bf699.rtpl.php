<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="content-body">
    <div class="list-body">
        <div class="list-body-content">
            <div class="list-body-top">
                <div class="list-category-title">
                    <h3 class="list-title">Usuarios</h3>
                </div>
                <div class="list-category-sub-title">
                    <p class="list-sub-title">lista de usuarios</p>
                </div>
            </div>
            <div class="list-body-middle">
                <div class="list-search-top">
                    <div class="search-dropdown-body">
                        <div class="dropdown-box">
                            <select name="cars" id="cars">
                            <option value="volvo">Nome</option>
                            <option value="saab">Identificador</option>
                            <option value="mercedes">CPF</option>
                          </select>
                        </div>
                    </div>
                    <div class="search-field-body">
                        <div class="search-input-group">
                            <div class="input-text">
                                <input type="text" class="search-text-input" aria-label="teste">
                                <button class="search-btn"><span>Buscar</span><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-table-body">
                    <table>
                        <thead>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Ação</th>
                        </thead>
                        <tbody>
                            <?php $counter1=-1;  if( isset($usuarios) && ( is_array($usuarios) || $usuarios instanceof Traversable ) && sizeof($usuarios) ) foreach( $usuarios as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td class="td-photo">
                                    <div class="table-photo"><img src="<?php echo htmlspecialchars( $value1["user_profilepicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt=""></div>
                                </td>
                                <td><?php echo htmlspecialchars( $value1["user_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td class="phone-mask"><?php echo htmlspecialchars( $value1["user_phone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><a class="view" href="/admin/user/profile<?php echo htmlspecialchars( $value1["user_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">Visualizar</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="new-element">
                    <a href="./user/create" class="new-element-button">
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

<script src="_js/jquery-3.6.0.min.js"></script>
<script src="_js/index.js"></script>

</html>