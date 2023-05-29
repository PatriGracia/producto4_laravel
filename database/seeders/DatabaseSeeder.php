<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Acto;
use App\Models\Documentacion;
use App\Models\Inscritos;
use App\Models\Lista_Ponentes;
use App\Models\Persona;
use App\Models\Tipos_usuario;
use App\Models\Tipo_acto;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //TIPOS DE USUARIO
        $tipo_usuario = new Tipos_usuario;
        $tipo_usuario2 = new Tipos_usuario;
        $tipo_usuario3 = new Tipos_usuario;

        $tipo_usuario->Descripcion = "Admin";
        $tipo_usuario2->Descripcion = "Usuario";
        $tipo_usuario3->Descripcion = "Ponente";

        $tipo_usuario->save();
        $tipo_usuario2->save();
        $tipo_usuario3->save();

        //PERSONAS
        $persona1 = new Persona;
        $persona1->Nombre = "Admin";
        $persona1->Apellido1 = "Prueba";
        $persona1->Apellido2 = "Prueba";

        $persona2 = new Persona;
        $persona2->Nombre = "Usuario";
        $persona2->Apellido1 = "Prueba";
        $persona2->Apellido2 = "Prueba";

        $persona3 = new Persona;
        $persona3->Nombre = "Ponente";
        $persona3->Apellido1 = "Prueba";
        $persona3->Apellido2 = "Prueba";

        $persona1->save();
        $persona2->save();
        $persona3->save();

        //USUARIOS
        $usuario1 = new Usuario;
        $usuario1->Username = "patri_admin";
        $usuario1->Password = "1234";
        $usuario1->Id_Persona = 1;
        $usuario1->Id_tipo_usuario = 1;

        $usuario2 = new Usuario;
        $usuario2->Username = "patri_prueba";
        $usuario2->Password = "1234";
        $usuario2->Id_Persona = 2;
        $usuario2->Id_tipo_usuario = 2;

        $usuario3 = new Usuario;
        $usuario3->Username = "patri_ponente";
        $usuario3->Password = "1234";
        $usuario3->Id_Persona = 3;
        $usuario3->Id_tipo_usuario = 3;

        $usuario1->save();
        $usuario2->save();
        $usuario3->save();
        
        //TIPOS DE ACTOS
        $tipo1 = new Tipo_acto;
        $tipo1->Descripcion = "Debate";
        $tipo2 = new Tipo_acto;
        $tipo2->Descripcion = "Ponencia";
        $tipo3 = new Tipo_acto;
        $tipo3->Descripcion = "Seminario";

        $tipo1->save();
        $tipo2->save();
        $tipo3->save();

        //ACTOS
        $acto1 = new Acto;
        $acto1->Fecha = "2023-05-19";
        $acto1->Hora = "12:30:00";
        $acto1->Titulo = "Ponencia MVC";
        $acto1->Descripcion_corta = "Introducción al Modelo-Vista-Controlador";
        $acto1->Descripcion_larga = "Wikipedia: Modelo-vista-controlador (MVC) es un patrón de arquitectura de software, que separa los datos y principalmente lo que es la lógica de negocio de una aplicación de su representación y el módulo encargado de gestionar los eventos y las comunicaciones";
        $acto1->Num_asistentes = 10;
        $acto1->Id_tipo_acto = 2;

        $acto2 = new Acto;
        $acto2->Fecha = "2023-05-10";
        $acto2->Hora = "10:30:00";
        $acto2->Titulo = "Debate ChatGPT";
        $acto2->Descripcion_corta = "ChatGPT sí o no";
        $acto2->Descripcion_larga = "¿Qué opinan los desarrolladores sobre el acceso libre a esta inteligencia?";
        $acto2->Num_asistentes = 5;
        $acto2->Id_tipo_acto = 1;

        $acto3 = new Acto;
        $acto3->Fecha = "2023-05-22";
        $acto3->Hora = "17:30:00";
        $acto3->Titulo = "Laravel";
        $acto3->Descripcion_corta = "Seminario Laravel";
        $acto3->Descripcion_larga = "Conceptos básicos sobre este Framework y primeros pasos";
        $acto3->Num_asistentes = 8;
        $acto3->Id_tipo_acto = 3;
        
        $acto4 = new Acto;
        $acto4->Fecha = "2023-05-16";
        $acto4->Hora = "15:45:00";
        $acto4->Titulo = "Seminario Hoy";
        $acto4->Descripcion_corta = "Prueba";
        $acto4->Descripcion_larga = "Prueba";
        $acto4->Num_asistentes = 1;
        $acto4->Id_tipo_acto = 3;

        $acto1->save();
        $acto2->save();
        $acto3->save();
        $acto4->save();

        //DOCUMENTACION
        $doc1 = new Documentacion;
        $doc1->Id_acto = 2;
        $doc1->Localizacion_documentacion = "Repositorio de la UOC";
        $doc1->Orden = 2;
        $doc1->Id_persona = 3;
        $doc1->Titulo_documento = "Preguntas GPT";

        $doc2 = new Documentacion;
        $doc2->Id_acto = 1;
        $doc2->Localizacion_documentacion = "Gmail";
        $doc2->Orden = 1;
        $doc2->Id_persona = 3;
        $doc2->Titulo_documento = "Model-View-Controller";

        $doc1->save();
        $doc2->save();

        //INSCRITOS
        $inscrito1 = new Inscritos;
        $inscrito1->Id_persona = 3;
        $inscrito1->id_acto = 3;
        $inscrito1->Fecha_inscripcion = "2023-05-02 13:43:07";

        $inscrito1->save();

        //LISTA DE PONENTES
        $ponente1 = new Lista_Ponentes;
        $ponente1->Id_persona = 3;
        $ponente1->Id_acto = 2;
        $ponente1->Orden = 2;

        $ponente2 = new Lista_Ponentes;
        $ponente2->Id_persona = 3;
        $ponente2->Id_acto = 1;
        $ponente2->Orden = 1;

        $ponente1->save();
        $ponente2->save();
    }
}
