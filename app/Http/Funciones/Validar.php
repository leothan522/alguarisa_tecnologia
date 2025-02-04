<?php
//Funciones Personalizadas para el Proyecto
use Illuminate\Support\Facades\Auth;

function comprobarPermisos($routeName = null)
{

    if (leerJson(Auth::user()->permisos, $routeName) || Auth::user()->role == 1 || Auth::user()->role == 100) {
        return true;
    } else {
        return false;
    }

}

function comprobarAccesoEmpresa($permisos, $user_id)
{
    if (leerJson($permisos, $user_id) || Auth::user()->roler == 1 || Auth::user()->role == 100){
        return true;
    }else{
        return false;
    }
}

function allPermisos()
{
    $permisos = [
        'Oficios' => [
            'route' => 'oficios.index',
            'submenu' => [
                'Crear Oficios' => 'oficios.create',
                'Editar Oficios' => 'oficios.edit',
                'Borrar Oficios' => 'oficios.destroy'
            ]
        ],
        'Bienes' => [
            'route' => 'bienes.index',
            'submenu' => [
                'Exportar Excel'      => 'bienes.export',
                'Imprimir Etiquetas'  => 'etiquetas.print',
                'Verificar Bienes'  => 'bienes.check',
                'Crear Bienes' => 'bienes.create',
                'Editar Bienes' => 'bienes.edit',
                'Borrar Bienes' => 'bienes.destroy',
            ]
        ],
        'Personas' => [
            'route' => 'personas.index',
            'submenu' => [
                'Crear Personas' => 'personas.create',
                'Editar Personas' => 'personas.edit',
                'Borrar Personas' => 'personas.destroy'
            ]
        ],
        'Instituciones' => [
            'route' => 'instituciones.index',
            'submenu' => [
                'Crear Instituciones' => 'instituciones.create',
                'Editar Instituciones' => 'instituciones.edit',
                'Borrar Instituciones' => 'instituciones.destroy'
            ]
        ],
        'Tipos' => [
            'route' => 'tipos.index',
            'submenu' => [
                'Crear Tipos' => 'tipos.create',
                'Editar Tipos' => 'tipos.edit',
                'Borrar Tipos' => 'tipos.destroy'

            ]
        ],
        'Marcas' => [
            'route' => 'marcas.index',
            'submenu' => [
                'Crear Marcas' => 'marcas.create',
                'Editar Marcas' => 'marcas.edit',
                'Borrar Marcas' => 'marcas.destroy'

            ]
        ],
        'Modelos' => [
            'route' => 'modelos.index',
            'submenu' => [
                'Crear Modelos' => 'modelos.create',
                'Editar Modelos' => 'modelos.edit',
                'Borrar Modelos' => 'modelos.destroy'

            ]
        ],
        'Colores' => [
            'route' => 'colores.index',
            'submenu' => [
                'Crear Colores' => 'colores.create',
                'Editar Colores' => 'colores.edit',
                'Borrar Colores' => 'colores.destroy'

            ]
        ],
        'Condiciones' => [
            'route' => 'condiciones.index',
            'submenu' => [
                'Crear Condiciones' => 'condiciones.create',
                'Editar Condiciones' => 'condiciones.edit',
                'Borrar Condiciones' => 'condiciones.destroy'

            ]
        ],
        'Ubicaciones' => [
            'route' => 'ubicaciones.index',
            'submenu' => [
                'Crear Ubicación' => 'ubicaciones.create',
                'Editar Ubicación' => 'ubicaciones.edit',
                'Borrar Ubicación' => 'ubicaciones.destroy'

            ]
        ],
        'Empresas' => [
            'route' => 'empresas.index',
            'submenu' => [
                'Abrir ó Cerrar' => 'empresas.estatus',
                'Definir Horarios' => 'empresas.horario',
                'Crear Empresas' => 'empresas.create',
                'Editar Empresas' => 'empresas.edit',
                'Borrar Empresas' => 'empresas.destroy'

            ]
        ],
        'Territorio' => [
            'route' => 'municipios.index',
            'submenu' => [
                'Crear Municipios' => 'municipios.create',
                'Editar Municipios' => 'municipios.edit',
                'Borrar Municipios' => 'municipios.destroy',
                'Crear Parroquias' => 'parroquias.create',
                'Editar Parroquias' => 'parroquias.edit',
                'Borrar Parroquias' => 'parroquias.destroy'
            ]
        ],
        'Usuarios' => [
            'route' => 'usuarios.index',
            'submenu' => [
                'Exportar Excel' => 'usuarios.excel',
                'Suspender Usuarios' => 'usuarios.estatus',
                'Restituir Contraseña' => 'usuarios.password',
                'Crear Usuarios' => 'usuarios.create',
                'Editar Usuarios' => 'usuarios.edit',
                'Borrar Usuarios' => 'usuarios.destroy',
            ]
        ],
    ];
    return $permisos;
}


function dataMunicipiosParroquias(): array
{
    /*$municipios = [
        [
            "id"=>1,
            "nombre"=>"JUAN GERMAN ROSCIO NIEVES",
            "mini"=>"ROSCIO",
            "parroquias"=>3
        ],
        [
            "id"=>2,
            "nombre"=>"FRANCISCO DE MIRANDA",
            "mini"=>"MIRANDA",
            "parroquias"=>4
        ],
        [
            "id"=>3,
            "nombre"=>"LEONARDO INFANTE",
            "mini"=>"INFANTE",
            "parroquias"=>2
        ],
        [
            "id"=>4,
            "nombre"=>"PEDRO ZARAZA",
            "mini"=>"ZARAZA",
            "parroquias"=>2
        ],
        [
            "id"=>5,
            "nombre"=>"JOSE TADEO MONAGAS",
            "mini"=>"MONAGAS",
            "parroquias"=>7
        ],
        [
            "id"=>6,
            "nombre"=>"JOSE FELIX RIBAS",
            "mini"=>"RIBAS",
            "parroquias"=>2
        ],
        [
            "id"=>7,
            "nombre"=>"CAMAGUAN",
            "mini"=>"CAMAGUAN",
            "parroquias"=>3
        ],
        [
            "id"=>8,
            "nombre"=>"JULIAN MELLADO",
            "mini"=>"MELLADO",
            "parroquias"=>2
        ],
        [
            "id"=>9,
            "nombre"=>"EL SOCORRO",
            "mini"=>"EL SOCORRO",
            "parroquias"=>1
        ],
        [
            "id"=>10,
            "nombre"=>"SANTA MARIA DE IPIRE",
            "mini"=>"SANTA MARIA",
            "parroquias"=>2
        ],
        [
            "id"=>11,
            "nombre"=>"CHAGUARAMAS",
            "mini"=>"CHAGUARAMAS",
            "parroquias"=>1
        ],
        [
            "id"=>12,
            "nombre"=>"JUAN JOSE RONDON",
            "mini"=>"RONDON",
            "parroquias"=>3
        ],
        [
            "id"=>13,
            "nombre"=>"SAN JOSE DE GUARIBE",
            "mini"=>"GUARIBE",
            "parroquias"=>1
        ],
        [
            "id"=>14,
            "nombre"=>"SAN GERONIMO DE GUAYABAL",
            "mini"=>"GUAYABAL",
            "parroquias"=>2
        ],
        [
            "id"=>15,
            "nombre"=>"ORTIZ",
            "mini"=>"ORTIZ",
            "parroquias"=>4
        ]
    ];
    $parroquias = [
        [
            "id"=>1,
            "nombre"=>"CAMAGUAN",
            "mini"=>null,
            "municipios_id"=>7
        ],
        [
            "id"=>2,
            "nombre"=>"PUERTO MIRANDA",
            "mini"=>null,
            "municipios_id"=>7
        ],
        [
            "id"=>3,
            "nombre"=>"UVERITO",
            "mini"=>null,
            "municipios_id"=>7
        ],
        [
            "id"=>4,
            "nombre"=>"CHAGUARAMAS",
            "mini"=>null,
            "municipios_id"=>11
        ],
        [
            "id"=>5,
            "nombre"=>"EL SOCORRO",
            "mini"=>null,
            "municipios_id"=>9
        ],
        [
            "id"=>6,
            "nombre"=>"CALABOZO",
            "mini"=>null,
            "municipios_id"=>2
        ],
        [
            "id"=>7,
            "nombre"=>"EL RASTRO",
            "mini"=>null,
            "municipios_id"=>2
        ],
        [
            "id"=>8,
            "nombre"=>"GUARDATINAJAS",
            "mini"=>null,
            "municipios_id"=>2
        ],
        [
            "id"=>9,
            "nombre"=>"EL CALVARIO",
            "mini"=>null,
            "municipios_id"=>2
        ],
        [
            "id"=>10,
            "nombre"=>"TUCUPIDO",
            "mini"=>null,
            "municipios_id"=>6
        ],
        [
            "id"=>11,
            "nombre"=>"SAN RAFAEL DE LAYA",
            "mini"=>null,
            "municipios_id"=>6
        ],
        [
            "id"=>12,
            "nombre"=>"ALTAGRACIA DE ORITUCO",
            "mini"=>"ALTAGRACIA",
            "municipios_id"=>5
        ],
        [
            "id"=>13,
            "nombre"=>"SAN RAFAEL DE ORITUCO",
            "mini"=>"SAN RAFAEL",
            "municipios_id"=>5
        ],
        [
            "id"=>14,
            "nombre"=>"LIBERTAD DE ORITUCO",
            "mini"=>"LIBERTAD",
            "municipios_id"=>5
        ],
        [
            "id"=>15,
            "nombre"=>"SAN FRANCISCO DE MACAIRA",
            "mini"=>"MACAIRA",
            "municipios_id"=>5
        ],
        [
            "id"=>16,
            "nombre"=>"PASO REAL DE MACAIRA",
            "mini"=>"PASO REAL",
            "municipios_id"=>5
        ],
        [
            "id"=>17,
            "nombre"=>"CARLOS SOUBLETTE",
            "mini"=>"SOUBLETTE",
            "municipios_id"=>5
        ],
        [
            "id"=>18,
            "nombre"=>"FRANCISCO JAVIER DE LAZAMA",
            "mini"=>"LEZAMA",
            "municipios_id"=>5
        ],
        [
            "id"=>19,
            "nombre"=>"SAN JUAN",
            "mini"=>null,
            "municipios_id"=>1
        ],
        [
            "id"=>20,
            "nombre"=>"PARAPARA",
            "mini"=>null,
            "municipios_id"=>1
        ],
        [
            "id"=>21,
            "nombre"=>"CANTAGALLO",
            "mini"=>null,
            "municipios_id"=>1
        ],
        [
            "id"=>22,
            "nombre"=>"LAS MERCEDES DEL LLANO",
            "mini"=>"LAS MERCEDES",
            "municipios_id"=>12
        ],
        [
            "id"=>23,
            "nombre"=>"SANTA RITA DE MANAPIRE",
            "mini"=>"SANTA RITA",
            "municipios_id"=>12
        ],
        [
            "id"=>24,
            "nombre"=>"CABRUTA",
            "mini"=>null,
            "municipios_id"=>12
        ],
        [
            "id"=>25,
            "nombre"=>"EL SOMBRERO",
            "mini"=>null,
            "municipios_id"=>8
        ],
        [
            "id"=>26,
            "nombre"=>"SOSA",
            "mini"=>null,
            "municipios_id"=>8
        ],
        [
            "id"=>27,
            "nombre"=>"VALLE DE LA PASCUA",
            "mini"=>null,
            "municipios_id"=>3
        ],
        [
            "id"=>28,
            "nombre"=>"ESPINO",
            "mini"=>null,
            "municipios_id"=>3
        ],
        [
            "id"=>29,
            "nombre"=>"Ortiz",
            "mini"=>null,
            "municipios_id"=>15
        ],
        [
            "id"=>30,
            "nombre"=>"SAN JOSE DE TIZNADOS",
            "mini"=>"SAN JOSE",
            "municipios_id"=>15
        ],
        [
            "id"=>31,
            "nombre"=>"SAN LORENZO DE TIZNADOS",
            "mini"=>"SAN LORENZO",
            "municipios_id"=>15
        ],
        [
            "id"=>32,
            "nombre"=>"SAN FRANCISCO DE TIZNADOSº",
            "mini"=>"SAN FRANCISCO",
            "municipios_id"=>15
        ],
        [
            "id"=>33,
            "nombre"=>"ZARAZA",
            "mini"=>null,
            "municipios_id"=>4
        ],
        [
            "id"=>34,
            "nombre"=>"SAN JOSE DE UNARE",
            "mini"=>null,
            "municipios_id"=>4
        ],
        [
            "id"=>35,
            "nombre"=>"GUAYABAL",
            "mini"=>null,
            "municipios_id"=>14
        ],
        [
            "id"=>36,
            "nombre"=>"CAZORLA",
            "mini"=>null,
            "municipios_id"=>14
        ],
        [
            "id"=>37,
            "nombre"=>"GUARIBE",
            "mini"=>null,
            "municipios_id"=>13
        ],
        [
            "id"=>38,
            "nombre"=>"SANTA MARIA",
            "mini"=>null,
            "municipios_id"=>10
        ],
        [
            "id"=>39,
            "nombre"=>"ALTAMIRA",
            "mini"=>null,
            "municipios_id"=>10
        ]
    ];*/
    $municipios = [
        [
            "id" => 1,
            "nombre" => "JUAN GERMAN ROSCIO NIEVES",
            "mini" => "ROSCIO",
            "parroquias" => 3,
            "familias" => 32586
        ],
        [
            "id" => 2,
            "nombre" => "FRANCISCO DE MIRANDA",
            "mini" => "MIRANDA",
            "parroquias" => 4,
            "familias" => 34452
        ],
        [
            "id" => 3,
            "nombre" => "LEONARDO INFANTE",
            "mini" => "INFANTE",
            "parroquias" => 2,
            "familias" => 24811
        ],
        [
            "id" => 4,
            "nombre" => "PEDRO ZARAZA",
            "mini" => "ZARAZA",
            "parroquias" => 2,
            "familias" => 20063
        ],
        [
            "id" => 5,
            "nombre" => "JOSE TADEO MONAGAS",
            "mini" => "MONAGAS",
            "parroquias" => 7,
            "familias" => 14086
        ],
        [
            "id" => 6,
            "nombre" => "JOSE FELIX RIBAS",
            "mini" => "RIBAS",
            "parroquias" => 2,
            "familias" => 9551
        ],
        [
            "id" => 7,
            "nombre" => "CAMAGUAN",
            "mini" => "CAMAGUAN",
            "parroquias" => 3,
            "familias" => 10160
        ],
        [
            "id" => 8,
            "nombre" => "JULIAN MELLADO",
            "mini" => "MELLADO",
            "parroquias" => 2,
            "familias" => 6838
        ],
        [
            "id" => 9,
            "nombre" => "EL SOCORRO",
            "mini" => "EL SOCORRO",
            "parroquias" => 1,
            "familias" => 7146
        ],
        [
            "id" => 10,
            "nombre" => "SANTA MARIA DE IPIRE",
            "mini" => "SANTA MARIA",
            "parroquias" => 2,
            "familias" => 4631
        ],
        [
            "id" => 11,
            "nombre" => "CHAGUARAMAS",
            "mini" => "CHAGUARAMAS",
            "parroquias" => 1,
            "familias" => 1588
        ],
        [
            "id" => 12,
            "nombre" => "JUAN JOSE RONDON",
            "mini" => "RONDON",
            "parroquias" => 3,
            "familias" => 420
        ],
        [
            "id" => 13,
            "nombre" => "SAN JOSE DE GUARIBE",
            "mini" => "GUARIBE",
            "parroquias" => 1,
            "familias" => 2936
        ],
        [
            "id" => 14,
            "nombre" => "SAN GERONIMO DE GUAYABAL",
            "mini" => "GUAYABAL",
            "parroquias" => 2,
            "familias" => 7096
        ],
        [
            "id" => 15,
            "nombre" => "ORTIZ",
            "mini" => "ORTIZ",
            "parroquias" => 4,
            "familias" => 6581
        ]
    ];

    $parroquias = [
        [
            "id" => 1,
            "nombre" => "CAMAGUAN",
            "mini" => null,
            "municipios_id" => 7
        ],
        [
            "id" => 2,
            "nombre" => "PUERTO MIRANDA",
            "mini" => null,
            "municipios_id" => 7
        ],
        [
            "id" => 3,
            "nombre" => "UVERITO",
            "mini" => null,
            "municipios_id" => 7
        ],
        [
            "id" => 4,
            "nombre" => "CHAGUARAMAS",
            "mini" => null,
            "municipios_id" => 11
        ],
        [
            "id" => 5,
            "nombre" => "EL SOCORRO",
            "mini" => null,
            "municipios_id" => 9
        ],
        [
            "id" => 6,
            "nombre" => "CALABOZO",
            "mini" => null,
            "municipios_id" => 2
        ],
        [
            "id" => 7,
            "nombre" => "EL RASTRO",
            "mini" => null,
            "municipios_id" => 2
        ],
        [
            "id" => 8,
            "nombre" => "GUARDATINAJAS",
            "mini" => null,
            "municipios_id" => 2
        ],
        [
            "id" => 9,
            "nombre" => "EL CALVARIO",
            "mini" => null,
            "municipios_id" => 2
        ],
        [
            "id" => 10,
            "nombre" => "TUCUPIDO",
            "mini" => null,
            "municipios_id" => 6
        ],
        [
            "id" => 11,
            "nombre" => "SAN RAFAEL DE LAYA",
            "mini" => null,
            "municipios_id" => 6
        ],
        [
            "id" => 12,
            "nombre" => "ALTAGRACIA DE ORITUCO",
            "mini" => "ALTAGRACIA",
            "municipios_id" => 5
        ],
        [
            "id" => 13,
            "nombre" => "SAN RAFAEL DE ORITUCO",
            "mini" => "SAN RAFAEL",
            "municipios_id" => 5
        ],
        [
            "id" => 14,
            "nombre" => "LIBERTAD DE ORITUCO",
            "mini" => "LIBERTAD",
            "municipios_id" => 5
        ],
        [
            "id" => 15,
            "nombre" => "SAN FRANCISCO DE MACAIRA",
            "mini" => "MACAIRA",
            "municipios_id" => 5
        ],
        [
            "id" => 16,
            "nombre" => "PASO REAL DE MACAIRA",
            "mini" => "PASO REAL",
            "municipios_id" => 5
        ],
        [
            "id" => 17,
            "nombre" => "CARLOS SOUBLETTE",
            "mini" => "SOUBLETTE",
            "municipios_id" => 5
        ],
        [
            "id" => 18,
            "nombre" => "FRANCISCO JAVIER DE LAZAMA",
            "mini" => "LEZAMA",
            "municipios_id" => 5
        ],
        [
            "id" => 19,
            "nombre" => "SAN JUAN",
            "mini" => null,
            "municipios_id" => 1
        ],
        [
            "id" => 20,
            "nombre" => "PARAPARA",
            "mini" => null,
            "municipios_id" => 1
        ],
        [
            "id" => 21,
            "nombre" => "CANTAGALLO",
            "mini" => null,
            "municipios_id" => 1
        ],
        [
            "id" => 22,
            "nombre" => "LAS MERCEDES DEL LLANO",
            "mini" => "LAS MERCEDES",
            "municipios_id" => 12
        ],
        [
            "id" => 23,
            "nombre" => "SANTA RITA DE MANAPIRE",
            "mini" => "SANTA RITA",
            "municipios_id" => 12
        ],
        [
            "id" => 24,
            "nombre" => "CABRUTA",
            "mini" => null,
            "municipios_id" => 12
        ],
        [
            "id" => 25,
            "nombre" => "EL SOMBRERO",
            "mini" => null,
            "municipios_id" => 8
        ],
        [
            "id" => 26,
            "nombre" => "SOSA",
            "mini" => null,
            "municipios_id" => 8
        ],
        [
            "id" => 27,
            "nombre" => "VALLE DE LA PASCUA",
            "mini" => null,
            "municipios_id" => 3
        ],
        [
            "id" => 28,
            "nombre" => "ESPINO",
            "mini" => null,
            "municipios_id" => 3
        ],
        [
            "id" => 29,
            "nombre" => "Ortiz",
            "mini" => null,
            "municipios_id" => 15
        ],
        [
            "id" => 30,
            "nombre" => "SAN JOSE DE TIZNADOS",
            "mini" => "SAN JOSE",
            "municipios_id" => 15
        ],
        [
            "id" => 31,
            "nombre" => "SAN LORENZO DE TIZNADOS",
            "mini" => "SAN LORENZO",
            "municipios_id" => 15
        ],
        [
            "id" => 32,
            "nombre" => "SAN FRANCISCO DE TIZNADOSº",
            "mini" => "SAN FRANCISCO",
            "municipios_id" => 15
        ],
        [
            "id" => 33,
            "nombre" => "ZARAZA",
            "mini" => null,
            "municipios_id" => 4
        ],
        [
            "id" => 34,
            "nombre" => "SAN JOSE DE UNARE",
            "mini" => null,
            "municipios_id" => 4
        ],
        [
            "id" => 35,
            "nombre" => "GUAYABAL",
            "mini" => null,
            "municipios_id" => 14
        ],
        [
            "id" => 36,
            "nombre" => "CAZORLA",
            "mini" => null,
            "municipios_id" => 14
        ],
        [
            "id" => 37,
            "nombre" => "GUARIBE",
            "mini" => null,
            "municipios_id" => 13
        ],
        [
            "id" => 38,
            "nombre" => "SANTA MARIA",
            "mini" => null,
            "municipios_id" => 10
        ],
        [
            "id" => 39,
            "nombre" => "ALTAMIRA",
            "mini" => null,
            "municipios_id" => 10
        ]

    ];

    return [$municipios, $parroquias];
}
