using api.Models;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Data.SqlClient;
using System.Data;

namespace api.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class DoctorsController : ControllerBase
    {
        private readonly IConfiguration _configuration;
        
        public DoctorsController(IConfiguration configuration)
        {
            _configuration = configuration;
        }

        [HttpGet]
        public JsonResult Get()
        {
            var query = @"SELECT DoctorID, DoctorName FROM Doctors";
            DataTable table = new DataTable();
            var sqlDataSource = _configuration.GetConnectionString("PetsDBCon");
            using (SqlConnection myConnection = new SqlConnection(sqlDataSource))
            {
                myConnection.Open();
                using (SqlCommand myCommand = new SqlCommand(query, myConnection))
                {
                    var sqlDataReader = myCommand.ExecuteReader();
                    table.Load(sqlDataReader);
                    sqlDataReader.Close();
                }
            }

            return new JsonResult(table);
        }

        [HttpPost]
        public JsonResult Post(Doctors doctors)
        {
            var query = @"INSERT INTO Doctors VALUES (@DoctorName)";
            DataTable table = new DataTable();
            var sqlDataSource = _configuration.GetConnectionString("PetsDBCon");
            using (SqlConnection myConnection = new SqlConnection(sqlDataSource))
            {
                myConnection.Open();
                using (SqlCommand myCommand = new SqlCommand(query, myConnection))
                {
                    myCommand.Parameters.AddWithValue("@DoctorName", doctors.DoctorName);
                    var sqlDataReader = myCommand.ExecuteReader();
                    table.Load(sqlDataReader);
                    sqlDataReader.Close();
                }
            }

            return new JsonResult("Успешно добавлено!");
        }

        [HttpPut]
        public JsonResult Put(Doctors doctors)
        {
            var query = @"UPDATE Doctors SET DoctorName=@DoctorName WHERE DoctorID=@DoctorID";
            DataTable table = new DataTable();
            var sqlDataSource = _configuration.GetConnectionString("PetsDBCon");
            using (SqlConnection myConnection = new SqlConnection(sqlDataSource))
            {
                myConnection.Open();
                using (SqlCommand myCommand = new SqlCommand(query, myConnection))
                {
                    myCommand.Parameters.AddWithValue("@DoctorID", doctors.DoctorID);
                    myCommand.Parameters.AddWithValue("@DoctorName", doctors.DoctorName);
                    var sqlDataReader = myCommand.ExecuteReader();
                    table.Load(sqlDataReader);
                    sqlDataReader.Close();
                }
            }

            return new JsonResult("Успешно обновлено!");
        }

        [HttpDelete("{id}")]
        public JsonResult Delete(int id)
        {
            var query = @"DELETE FROM Doctors WHERE DoctorID=@DoctorID";
            DataTable table = new DataTable();
            var sqlDataSource = _configuration.GetConnectionString("PetsDBCon");
            using (SqlConnection myConnection = new SqlConnection(sqlDataSource))
            {
                myConnection.Open();
                using (SqlCommand myCommand = new SqlCommand(query, myConnection))
                {
                    myCommand.Parameters.AddWithValue("@DoctorIDs", id);
                    var sqlDataReader = myCommand.ExecuteReader();
                    table.Load(sqlDataReader);
                    sqlDataReader.Close();
                }
            }

            return new JsonResult("Успешно удалено!");
        }
    }
}
