const express = require('express');
const axios = require('axios');

const app = express();
const port = 3000; // Change this to your desired port
const phpApiUrl = 'http://localhost/PHP/rest.php'; // Replace with the URL of your PHP API

app.get('/tt', async (req, res) => {
  try {
    const response = await axios.get(phpApiUrl);
    const data = response.data;
    res.json(data);
  } catch (error) {
    res.status(500).json({ error: 'An error occurred while calling the PHP API' });
  }
});

app.listen(port, () => {
  console.log(`Express server is running on port ${port}`);
});
