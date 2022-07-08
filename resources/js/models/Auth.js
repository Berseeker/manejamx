class Auth {
    static login(data, then, error) {
        axios.post('/login', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static register(data, then, error) {
        axios.post('/register', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Auth;
