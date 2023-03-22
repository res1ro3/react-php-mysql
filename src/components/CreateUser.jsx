import axios from "axios"
import { useState, useEffect } from "react";

export default function ListUser() {

    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [mobile, setMobile] = useState("");
    const [status, setStatus] = useState(0);

    const handleSubmit = async (e) => {
        e.preventDefault();
        console.log("Name: " + name + "/nEmail: " + email + "/nMobile: " + mobile);

        axios.post('http://localhost:80/react-php-mysql/api/index.php', {
            name: name,
            email: email,
            mobile: mobile
        }).then(function(response) {
            console.log(response);
            setStatus(response.data.status);
        });
    }

    useEffect(() => {
        if (status) {
            alert("User Added!");
            setName("");
            setEmail("");
            setMobile("");
            setStatus(0);
        }
    },[status])

    return (
        <div className="createUser">
            <h1>Create Users</h1>
            <form>
                <div className="mb-3">
                    <label htmlFor="nameInp" className="form-label">Name</label>
                    <input 
                        type="text" 
                        className="form-control" 
                        id="nameInp"
                        onChange={(e) => {setName(e.target.value)}}
                        value={name}
                    />
                </div>
                <div className="mb-3">
                    <label htmlFor="emailInp" className="form-label">Email</label>
                    <input 
                        type="email" 
                        className="form-control" 
                        id="emailInp"
                        onChange={(e) => {setEmail(e.target.value)}}
                        value={email}
                    />
                </div>
                <div className="mb-3">
                    <label htmlFor="mobileInp" className="form-label">Mobile</label>
                    <input 
                        type="text" 
                        className="form-control" 
                        id="mobileInp"
                        onChange={(e) => {setMobile(e.target.value)}}
                        value={mobile}
                    />
                </div>
                <button onClick={handleSubmit} type="submit" className="btn btn-primary">Submit</button>
            </form>
        </div>
    );
  }