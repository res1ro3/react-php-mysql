import './App.css'
import { Routes, Route } from 'react-router-dom'
import Navbar from './components/Navbar'
import ListUser from './components/ListUser'
import CreateUser from './components/CreateUser'
// import UpdateUser from './components/UpdateUser'

function App() {

  return (
    <div className="App">
      <Navbar />
      <Routes>
        <Route path='/' element={<ListUser />} />
        <Route path='/user/list' element={<ListUser />} />
        <Route path='/user/create' element={<CreateUser />} />
        {/* <Route path='/user/:id/edit' element={<UpdateUser />} /> */}
      </Routes>
    </div>
  )
}

export default App
