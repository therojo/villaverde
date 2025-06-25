<aside class="main-sidebar">

    <section class="sidebar">

    <?php

    $menuItems = [];

    if (Yii::$app->user->isGuest) {
        $menuItems = [
            ['label' => 'Login', 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
        ];
    } else {
        
        $menuItems[] = [
            'label' => 'Cuotas', 'icon' => 'piggy-bank', 'url' => ['/pagos'],
            'visible' => !Yii::$app->user->isGuest
        ];

        $menuItems[] = [
            'label' => 'Colonos', 'icon' => 'users', 'url' => ['/colonos'],
            'visible' => !Yii::$app->user->isGuest
        ];
        
        $menuItems[] = [
            'label' => 'Egresos', 'icon' => 'dollar-sign', 'url' => ['/egresos'],
            'visible' => !Yii::$app->user->isGuest
        ];
        $menuItems[] = [
            'label' => 'Domicilios', 'icon' => 'home', 'url' => ['/inmuebles'],
            'visible' => !Yii::$app->user->isGuest
        ];
        $menuItems[] = [
            'label' => 'Chips', 'icon' => 'car', 'url' => ['/chips'],
            'visible' => !Yii::$app->user->isGuest
        ];
        //$menuItems[] = [
        //    'label' => 'Domicilios', 'icon' => 'building', 'url' => ['/inmuebles-colonos'],
        //    'visible' => !Yii::$app->user->isGuest
        //];

        $menuItems[]=[
            'label' => 'Bloqueos',
            'icon' => 'cut',
            'url' => ['reportes/bloqueos'],
            'visible' => !Yii::$app->user->isGuest
            // 'visible'=> Yii::$app->session['tipo'] == Personas::_DIRECTOR  
        ];

        $menuItems[]=[
          'label' => 'Por Bloquear',
          'icon' => 'cut',
          'url' => ['reportes/bloqueos-v1'],
          'visible' => !Yii::$app->user->isGuest
          // 'visible'=> Yii::$app->session['tipo'] == Personas::_DIRECTOR  
        ];

         $menuItems[]=[
            'label' => 'Catalogos',
            'icon' => 'book',
            'badge' => '<span class="right fs-6 badge badge-success">Catalogos</span>',
            'items' => [
                [
                    'label' => 'Calles',
                    'icon' => 'bolt',
                    'url' => ['calles'],
                    'visible' => !Yii::$app->user->isGuest
                    // 'visible'=> Yii::$app->session['tipo'] == Personas::_DIRECTOR  
                ],
                $menuItems[] = [
                    'label' => 'Bloques', 'icon' => 'book', 'url' => ['/talones'],
                    'visible' => !Yii::$app->user->isGuest
                ],
                [
                    'label' => 'Partidas',
                    'icon' => 'home',
                    'url' => ['partidas'],
                    'visible' => !Yii::$app->user->isGuest
                    // 'visible'=> Yii::$app->session['tipo'] == Personas::_DIRECTOR  
                ],
                [
                    'label' => 'Usuarios',
                    'icon' => 'bolt',
                    'url' => ['usuarios'],
                    'visible' => !Yii::$app->user->isGuest
                    // 'visible'=> Yii::$app->session['tipo'] == Personas::_DIRECTOR  
                ],
            ]                                                  
         ];

        $menuItems[]=[
            'label' => 'Reportes',
            'icon' => 'tachometer-alt',
            'badge' => '<span class="right fs-6 badge badge-success">Oficios</span>',                                        
            'items' => [
                [
                    'label' => 'General',
                    'icon' => 'bolt',
                    'url' => ['reportes/general'],
                    'visible' => !Yii::$app->user->isGuest
                    // 'visible'=> Yii::$app->session['tipo'] == Personas::_DIRECTOR  
                ],
                [
                    'label' => 'Arqueo',
                    'icon' => 'dollar-sign',
                    'url' => ['reportes/arqueo'],
                    'visible' => !Yii::$app->user->isGuest
                    // 'visible'=> Yii::$app->session['tipo'] == Personas::_DIRECTOR  
                ],
            ],
        ]; 

        // $menuItems[] = [
        //     'label' => 'Ejercicios', 'icon' => 'graduation-cap', 'url' => ['/ejercicios'],
        //     'visible' => !Yii::$app->user->isGuest
        // ];
        
        $menuItems[] = [
            'label' => 'Cambiar contraseña', 'icon' => 'key', 'url' => ['/usuarios/cambiar'],
            'visible' => !Yii::$app->user->isGuest
        ];
    }

    ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuItems

                /*
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],

                */
            ]
        ) ?>

    </section>

</aside>
