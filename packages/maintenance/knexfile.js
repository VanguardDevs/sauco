require('dotenv').config();

module.exports = {
  client: 'pg',
  connection: {
    host: process.env.MAINTENANCE_HOST,
    user: process.env.MAINTENANCE_USERNAME,
    password: process.env.MAINTENANCE_PASSWORD,
    database: process.env.MAINTENANCE_DATABASE
  }
};
