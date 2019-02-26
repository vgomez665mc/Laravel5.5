<?php
Use App\Articulo;
Use App\Cliente;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', "PaginasController@vista");
Route::get('quienesSomos', "PaginasController@quienesSomos");
Route::get('dondeEstamos', "PaginasController@dondeEstamos");
Route::get('foro', "PaginasController@foro");
Route::get('contacto', "PaginasController@contacto");
Route::get('mostrar', "PaginasController@mostrar");
Route::resource('post', "RecusosController");



//--------------------------------------Query de Sql Normal-----------------------------------------


//--------------------------------------Insertar-----------------------------------------

Route::get('insertar', function(){
	DB::insert("INSERT INTO articulos (NOMBRE_Articulo,precio,pais_origen,observaciones,seccion) VALUES (?,?,?,?,?)",["JARRON",14.2,"CERAMICA","GANGA","primera"]);
});

//--------------------------------------Leer-----------------------------------------

/*
Route::get('leer', function(){
	$resultados=DB::select("SELECT * FROM articulos WHERE ID=?",[1]);

	foreach($resultados as $articulo) {
		return $articulo->Nombre_Articulo;
	}
});

//--------------------------------------Actualizar-----------------------------------------


Route::get('actualiza', function(){
	DB::update("UPDATE articulos SET seccion='Decoracion' WHERE ID=?",[1]);

});

//--------------------------------------Eliminar-----------------------------------------

Route::get('eliminar', function(){
	DB::update("DELETE FROM articulos WHERE ID=?",[1]);
});*/







//----------------------------------------------Query´s en Elocuent---------------------------------


//-----------------------------------------Metodos de Mostrar o Leer---------------------------------


/*//mostrar registros con base a una columna
Route::get('leer',function(){
		$articulos= \App\Articulo::where('pais_origen','chile')
		->orderBy('precio','asc')
		->take(3)
		->get();
		return $articulos;


});*/



//mostrar un registro segun un id
Route::get('leer',function(){
		$articulos= \App\Articulo::find(3);
		
		return $articulos;
});



//mostrar un registro segun un id que este en la papelera,se uso softdelete
Route::get('leerPapelera',function(){
	$articulos = App\Articulo::withTrashed()
                ->where('id', 2)
                ->get();
		
	return $articulos;
});



// mostrar todos los registros e imprimes el array que te devuelve el all
/*
Route::get('leer',function(){
	$articulos= \App\Articulo::all();
	foreach ($articulos as $articulo) {
		echo $articulo->Nombre_Articulo;
	}

});*/


//-----------------------------------------Metodos de insercion-------------------------------------


/*//insertar un nuevo registro
Route::get('insertar',function(){
		$articulos=new \App\Articulo;
		$articulos->Nombre_Articulo="Jabon";
		$articulos->precio=30.1;
		$articulos->pais_origen="canada";
		$articulos->observaciones="pp";
		$articulos->seccion="detergente";
	    $articulos->save();
});*/


//insertar campos de forma masiva,recordar que tienes que declarar en el modelo el fillable
Route::get('insersionmasiva',function(){
	\App\Articulo::create(['Nombre_Articulo' => 'pan','precio'=>10,'pais_origen'=>'chile','observaciones'=>'detergente','seccion'=>'primera']);
});


//-----------------------------------------Metodos de actualizar-------------------------------------


/* //actualizar un unico regisstro
Route::get('actulizar',function(){
		$articulos= \App\Articulo::find(7);
		$articulos->Nombre_Articulo="Jabon";
		$articulos->precio=88.1;
		$articulos->pais_origen="canada";
		$articulos->observaciones="pp";
		$articulos->seccion="detergente";
	    $articulos->save();
});
*/



//actualizar un campo con base a dos columnas
Route::get('actulizar',function(){
		\App\Articulo::where("seccion","Menaje")
		->where("pais_origen","canada")
		->update(["precio"=>100]);


});


//-----------------------------------------Metodos de borrar-------------------------------------



//borrar un registro con base a un id
Route::get('borrar',function(){
	$articulos=\App\Articulo::find(4);
	$articulos->delete();
});

//borrar segun una columna

Route::get('borrar2',function(){
	\App\Articulo::where("observaciones","csv")->delete();
});


//borra un registro segun un id y lo envia a la papelera
Route::get('softdelete',function(){
	\App\Articulo::find(3)->delete();
});

//borra los registro permanentemente de la papelera
Route::get('borrarPermanenteSoft',function(){
	$articulos = App\Articulo::withTrashed()
                ->where('id', 3)
                ->forceDelete();
});
//-----------------------------------------Metodos de restauracion de registro----------------------

//Restaurar un registro segun un id que este en la papelera,se uso softdelete
Route::get('restaurarRegistro',function(){
	$articulos = App\Articulo::withTrashed()
                ->where('id', 3)
                ->restore();
});




//--------------------------------------------------prueba de ruta de One to One--------------


Route::get('cliente/{id}/articulo',function($id){
	return \App\Cliente::find($id)->articulo;
});

//--------------------------------------------------Inverse Of The Relationship--------------
Route::get('articulo/{id}/cliente',function($id){
	return \App\Articulo::find($id)->cliente->Nombre->Apellido;
});

//--------------------------------------------------prueba de ruta de One to Many--------------

Route::get('articulos',function(){
	$articulos = Cliente::find(1)->articulos->where("pais_origen","canada");

	foreach ($articulos as $articulo) {
	    echo $articulo->Nombre_Articulo ."<br/>";
	}

});


//--------------------------------------------------prueba de ruta de Many to Many--------------

Route::get('cliente/{id}/perfil',function($id){
	$clientes = Cliente::find($id);

	foreach ($clientes->perfils as $perfil) {
		return $perfil->Nombre;
    	
	}
});