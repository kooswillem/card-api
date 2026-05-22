const express = require('express');
const app = express();
const PORT = process.env.PORT || 3000;

app.use(express.json());

// !! NEW: Enable CORS so your website can talk to your backend !!
app.use((req, res, next) => {
    res.header("Access-Control-Allow-Origin", "*"); // Allows access from any frontend
    res.header("Access-Control-Allow-Methods", "GET, POST, DELETE, OPTIONS");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    if (req.method === 'OPTIONS') {
        return res.sendStatus(200);
    }
    next();
});

let items = [
    { id: 1, name: "First Item" },
    { id: 2, name: "Second Item" }
];

app.get('/api/items', (req, res) => {
    res.status(200).json(items);
});

app.post('/api/items', (req, res) => {
    if (!req.body.name) return res.status(400).json({ error: "Name required" });
    const newItem = { id: Date.now(), name: req.body.name }; // Using timestamp for unique ID
    items.push(newItem);
    res.status(201).json(newItem);
});

// !! NEW: Add the DELETE route handler !!
app.delete('/api/items/:id', (req, res) => {
    const idToId = parseInt(req.params.id);
    items = items.filter(item => item.id !== idToId);
    res.status(200).json({ success: true });
});

app.listen(PORT, () => console.log(`Running on port ${PORT}`));
