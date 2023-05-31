import {useEffect, useState} from "react";
import axios from "axios";

function App() {

    axios.defaults.baseURL = 'http://localhost'
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.withCredentials = true;

    useEffect(() => {
        axios.get('/sanctum/csrf-cookie')
            .then(() =>
                axios.post('/api/login', {
                    email: 'admin@example.com',
                    password: 'secret',
                }))
            .then(() => axios.get('/api/user'))
            .then(() => axios.post('/api/logout'))
    }, [])

    return (
        <div>
            Hello
        </div>
    );
}

export default App;
