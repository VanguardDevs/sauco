require('dotenv').config();

module.exports = {
  client: 'pg',
  connection: {
    host: process.env.DB_MAINTENANCE_HOST,
    user: process.env.DB_MAINTENANCE_USERNAME,
    password: process.env.DB_MAINTENANCE_PASSWORD,
    database: process.env.DB_MAINTENANCE_DATABASE
  }
};
