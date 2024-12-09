import React from 'react';
import ReactDOM from 'react-dom';
// resources/js/app.jsx
import '../css/style.css';  

function Example() {
    return <div>Hello, world!</div>;
}

const root = document.getElementById('app');
if (root) {
    ReactDOM.render(<Example />, root);
}
