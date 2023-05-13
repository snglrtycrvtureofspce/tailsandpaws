import {variables} from './Variables.js';
import logo from './logo.svg';
import './App.css';

function App() {
    return (
      <div className="App">
        <header className="App-header">
          <img src={logo} className="App-logo" alt="logo" />
          <p>
            Edit <code>src/App.js</code> and save to reload.
          </p>
          <a
            className="App-link"
            href="https://reactjs.org"
            target="_blank"
            rel="noopener noreferrer"
          >
            Learn React
          </a>
        </header>
      </div>
    );
  }
export class Doctors extends Component {
    
    constructor(props){
        super(props);

        this.state={
            doctorss:[],
            modalTitle:"",
            DoctorName:"",
            DoctorID:0,

            DoctorIDFilter:"",
            DoctorNameFilter:"",
            doctorssWithoutFilter:[]
        }
    }

    FilterFn(){
        var DoctorIDFilter=this.state.DoctorIDFilter;
        var DoctorNameFilter=this.state.DoctorNameFilter;

        var filteredData=this.state.doctorssWithoutFilter.filter(
            function(el){
                return el.DoctorID.toString().toLowerCase().includes(
                    DoctorIDFilter.toString().trim().toLowerCase()
                )&&
                el.DoctorName.toString().toLowerCase().includes(
                    DoctorNameFilter.toString().trim().toLowerCase()
                )
            }
        );

        this.setState({doctorss:filteredData});
    }

    sortResult(prop,asc){
        var sortedData=this.state.doctorssWithoutFilter.sort(function(a,b){
            if(asc){
                return (a[prop]>b[prop])?1:((a[prop]<b[prop])?-1:0);
            }
            else{
                return (b[prop]>a[prop])?1:((b[prop]<a[prop])?-1:0);
            }
        });

        this.setState({doctorss:sortedData});
    }

    changeDoctorIDFilter = (e)=>{
        this.state.DoctorIDFilter=e.target.value;
        this.FilterFn();
    }
    changeDoctorNameFilter = (e)=>{
        this.state.DoctorNameFilter=e.target.value;
        this.FilterFn();
    }

    refreshList(){
        fetch(variables.API_URL+'doctors')
        .then(response=>response.json())
        .then(data=>{
            this.setState({doctorss:data,doctorssWithoutFilter:data});
        });
    }

    componentDidMount(){
        this.refreshList();
    }

    changeDoctorID =(e)=>{
        this.setState({DoctorID:e.target.value});
    }

    changeDoctorName =(e)=>{
        this.setState({DoctorName:e.target.value});
    }

    addClick(){
        this.setState({
            modalTitle:"Добавить врача",
            DoctorID:0,
            DoctorName:""
        });
    }
    editClick(at){
        this.setState({
            modalTitle:"Изменить врача",
            DoctorID:at.DoctorID,
            DoctorName:at.DoctorName
        });
    }

    createClick(){
        fetch(variables.API_URL+'doctors',{
            method:'POST',
            headers:{
                'Accept':'application/json',
                'Content-Type':'application/json'
            },
            body:JSON.stringify({
                DoctorName:this.state.DoctorName
            })
        })
        .then(res=>res.json())
        .then((result)=>{
            alert(result);
            this.refreshList();
        },(error)=>{
            alert('Ошибка создания.');
        })
    }

    updateClick(){
        fetch(variables.API_URL+'doctors',{
            method:'PUT',
            headers:{
                'Accept':'application/json',
                'Content-Type':'application/json'
            },
            body:JSON.stringify({
                DoctorID:this.state.DoctorID,
                DoctorName:this.state.DoctorName
            })
        })
        .then(res=>res.json())
        .then((result)=>{
            alert(result);
            this.refreshList();
        },(error)=>{
            alert('Ошибка обновления.');
        })
    }

    deleteClick(id){
        if(window.confirm('Вы уверены?')){
        fetch(variables.API_URL+'doctors/'+id,{
            method:'DELETE',
            headers:{
                'Accept':'application/json',
                'Content-Type':'application/json'
            }
        })
        .then(res=>res.json())
        .then((result)=>{
            alert(result);
            this.refreshList();
        },(error)=>{
            alert('Ошибка удаления');
        })
        }
    }

    render(){
        const {
            doctorss,
            modalTitle,
            DoctorID,
            DoctorName
        }=this.state;
        return(
            <div>

        <button type="button"
        className="btn btn-primary m-2 float-end"
        data-bs-toggle="modal"
        data-bs-target="#exampleModal"
        onClick={()=>this.addClick()}>
            Добавить врача
        </button>
        <table className="table table-striped">
        <thead>
        <tr>
            <th>
                <div className="d-flex flex-row">
                <input className="form-control m-2"
                onChange={this.changeDoctorIDFilter}
                placeholder="Filter"/>
                
                <button type="button" className="btn btn-light"
                onClick={()=>this.sortResult('DoctorID',true)}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0z"/>
                    </svg>
                </button>

                <button type="button" className="btn btn-light"
                onClick={()=>this.sortResult('DoctorID',false)}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-arrow-up-square-fill" viewBox="0 0 16 16">
                    <path d="M2 16a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2zm6.5-4.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 1 0z"/>
                    </svg>
                </button>
                </div>
                ID Врача
            </th>
            <th>
                <div className="d-flex flex-row">
                <input className="form-control m-2"
                onChange={this.changeDoctorNameFilter}
                placeholder="Filter"/>
                
                <button type="button" className="btn btn-light"
                onClick={()=>this.sortResult('DoctorName',true)}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0z"/>
                    </svg>
                </button>

                <button type="button" className="btn btn-light"
                onClick={()=>this.sortResult('DoctorName',false)}>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-arrow-up-square-fill" viewBox="0 0 16 16">
                    <path d="M2 16a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2zm6.5-4.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 1 0z"/>
                    </svg>
                </button>
                </div>
                Имя врача
            </th>
            <th>
                Настройки
            </th>
        </tr>
        </thead>
        <tbody>
            {doctorss.map(at=>
                <tr key={at.DoctorID}>
                    <td>{at.DoctorID}</td>
                    <td>{at.DoctorName}</td>
                    <td>
                    <button type="button"
                    className="btn btn-light mr-1"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    onClick={()=>this.editClick(at)}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fillRule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </button>

                    <button type="button"
                    className="btn btn-light mr-1"
                    onClick={()=>this.deleteClick(at.DoctorID)}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                    </button>
                    </td>
                </tr>
                )}
        </tbody>
        </table>

    <div className="modal fade" id="exampleModal" tabIndex="-1" aria-hidden="true">
    <div className="modal-dialog modal-lg modal-dialog-centered">
    <div className="modal-content">
    <div className="modal-header">
        <h5 className="modal-title">{modalTitle}</h5>
        <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"
        ></button>
    </div>

    <div className="modal-body">
        <div className="input-group mb-3">
            <div className="input-group mb-3"></div>
            <span className="input-group-text">Имя врача</span>
            <select className="form-select"
            onChange={this.changeDoctorName}
            value={DoctorName}>
                {doctorss.map(at=><option key={at.DoctorName}>
                    {at.DoctorName}
                </option>)}
            </select>
        </div>

            {DoctorID==0?
            <button type="button"
            className="btn btn-primary float-start"
            onClick={()=>this.createClick()}
            >Создать</button>
            :null}

            {DoctorID!=0?
            <button type="button"
            className="btn btn-primary float-start"
            onClick={()=>this.updateClick()}
            >Обновить</button>
            :null}
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        )
    }
}

export default App;