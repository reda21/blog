import axios from "axios";

export default async term => {
     let response = await axios.get('https://reqres.in/api/users')
        .then(function (response) {
            // handle success
            console.log(response);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });

    return response;
}
