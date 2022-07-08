class User {
    static updatePersonalDetails(element, data, then, error) {
        axios.put('/api/site/users/' + element + '/personal-details', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static updatePassword(element, data, then, error) {
        axios.put('/api/site/users/' + element + '/password', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static toggleNotifications(element, then, error) {
        axios.put('/api/site/users/' + element + '/toggle-notifications')
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default User;
