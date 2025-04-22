const express = require('express');
const path = require('path');
const app = express();
const PORT = 3000;

// Middleware untuk file statis
app.use(express.static(path.join(__dirname, 'public')));
app.use(express.json());

// Data sementara
let events = [];
let contacts = [];

// API Endpoint untuk events
app.get('/api/events', (req, res) => {
  res.json(events);
});

app.post('/api/events', (req, res) => {
  const newEvent = {
    id: Date.now(),
    ...req.body,
    createdAt: new Date()
  };
  events.push(newEvent);
  res.status(201).json(newEvent);
});

// API Endpoint untuk contacts
app.post('/api/contacts', (req, res) => {
  const newContact = {
    id: Date.now(),
    ...req.body,
    createdAt: new Date()
  };
  contacts.push(newContact);
  res.status(201).json(newContact);
});

// Tangani semua route lainnya ke index.html
app.get('*', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
app.use(cors());