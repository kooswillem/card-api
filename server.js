const express = require('express');
const app = express();
const PORT = process.env.PORT || 3000;

// Middleware to automatically parse incoming JSON data
app.use(express.json());

// Mock database
let items = [
    { id: 1, name: "First Item" },
    { id: 2, name: "Second Item" }
];

// GET Route: Fetch all items
app.get('/api/items', (req, res) => {
    res.status(200).json(items);
});

// POST Route: Add a new item
app.post('/api/items', (req, res) => {
    const newItem = {
        id: items.length + 1,
        name: req.body.name
    };
    if (!req.body.name) {
        return res.status(400).json({ error: "Name is required" });
    }
    items.push(newItem);
    res.status(201).json(newItem);
});

// Start the server
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
