<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
        </div>

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?= backend\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Catalogs', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Catalogs',
                        'icon' => 'fa fa-book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Categories', 'icon' => 'fa fa-file-code-o', 'url' => ['catalog/category'],],
                            ['label' => 'Products', 'icon' => 'fa fa-file-code-o', 'url' => ['catalog/product'],],
                            ['label' => 'Guides', 'icon' => 'fa fa-file-code-o', 'url' => ['catalog/guide'],],
                        ],
                    ],
                    ['label' => 'Theme', 'options' => ['class' => 'header']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Gii', 'icon' => 'fa fa-dashboard', 'url' => ['/gii']],
                ],
            ]
        ) ?>

    </section>

</aside>
