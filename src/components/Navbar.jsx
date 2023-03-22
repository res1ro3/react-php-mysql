// //Routing
import '../styles/navbar.css'
import { HashLink as Link } from "react-router-hash-link";

const Navbar = () => {

  return (
    <>
      <nav className='navbar sticky-top '>
        <ul>
          <Link to='/user/list' onClick={() => {setDoucmentTitle("List User");}}>
            <li>List User</li>
          </Link>
          <Link to='/user/create' onClick={() => {setDoucmentTitle("Create User");}}>
            <li>Create User</li>
          </Link>
          <Link to='/update' onClick={() => {setDoucmentTitle("Update User");}}>
            <li>Update User</li>
          </Link>
        </ul>
      </nav>
    </>
  )
}
export default Navbar
