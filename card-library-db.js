const mysql = require('mysql2');
const connection = mysql.createConnection({
  host: 'https://cdn.service.inepro.com/',
  user: 'manualsinepro_rfid-media-librarian',
  password: '#vNXPW@2slX4',
  database: 'manualsinepro_rfid-media-library'
});
