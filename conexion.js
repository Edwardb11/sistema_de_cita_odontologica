//variable de conexion
//var modulo = require('export');
var mysql = require('mysql');

var conexion = mysql.createConnection({

    host: 'localhost',
    database: 'perfect_teeth',
    user: 'root',
    password: ''
});

//conexion a la base de datos
conexion.connect(function (error) {
    if (error) {
        throw error; //para que muestre el error
    }
    else {
        console.log('Conexion exitosa');
    }
});

export { mysql, conexion };
//conexion.end();
/*
//consultas
conexion.query('SELECT * FROM login', function (error, results) {
    if (error) {
        throw error;
    }
    results.forEach(result => {
        console.log(result);
    })
});

conexion.end();*/