require('dotenv').config();

module.exports = {
  client: 'pg',
  connection: {
    host: process.env.RECAUDO_HOST,
    user: process.env.RECAUDO_USERNAME,
    password: process.env.RECAUDO_PASSWORD,
    database: process.env.RECAUDO_DATABASE
  }
};
