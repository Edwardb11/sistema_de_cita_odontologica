import { conexion } from './conexion.js';

conexion.query('SELECT * FROM login', function (error, results) {
    if (error) {
        throw error;
    }
    results.forEach(result => {
        console.log(result);
    })
});

conexion.end();
