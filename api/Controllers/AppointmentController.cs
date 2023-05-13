using Microsoft.AspNetCore.Mvc;
using Microsoft.Data.SqlClient;
using System.Data;
using api.Models;

namespace api.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class AppointmentController : ControllerBase
    {
        private readonly IConfiguration _configuration;

        public AppointmentController(IConfiguration configuration)
        {
            _configuration = configuration;
        }

        [HttpGet]
        public JsonResult Get()
        {
            var query = @"SELECT AppointmentID, AppointmentFIO, AppointmentEmail, ServiceID, DoctorID, AppointmentDate, AppointmentTime FROM Appointment";
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
        public JsonResult Post(Appointment appointment)
        {
            var query = @"INSERT INTO Appointment VALUES (@AppointmentFIO, @AppointmentEmail, @ServiceID, DoctorID, AppointmentDate, AppointmentTime)";
            DataTable table = new DataTable();
            var sqlDataSource = _configuration.GetConnectionString("PetsDBCon");
            using (SqlConnection myConnection = new SqlConnection(sqlDataSource))
            {
                myConnection.Open();
                using (SqlCommand myCommand = new SqlCommand(query, myConnection))
                {
                    myCommand.Parameters.AddWithValue("@AppointmentFIO", appointment.AppointmentFIO);
                    myCommand.Parameters.AddWithValue("@AppointmentEmail", appointment.AppointmentEmail);
                    myCommand.Parameters.AddWithValue("@ServiceID", appointment.ServiceID);
                    myCommand.Parameters.AddWithValue("@DoctorID", appointment.DoctorID);
                    myCommand.Parameters.AddWithValue("@AppointmentDate", appointment.AppointmentDate);
                    myCommand.Parameters.AddWithValue("@AppointmentTime", appointment.AppointmentTime);
                    var sqlDataReader = myCommand.ExecuteReader();
                    table.Load(sqlDataReader);
                    sqlDataReader.Close();
                }
            }

            return new JsonResult("Успешно добавлено!");
        }

        [HttpPut]
        public JsonResult Put(Appointment appointment)
        {
            var query = @"UPDATE Appointment SET AppointmentFIO=@AppointmentFIO, AppointmentEmail=@AppointmentEmail, ServiceID=@ServiceID, DoctorID=@DoctorID, AppointmentDate=@AppointmentDate, AppointmentTime=@AppointmentTime, WHERE AppointmentID=@AppointmentID";
            DataTable table = new DataTable();
            var sqlDataSource = _configuration.GetConnectionString("PetsDBCon");
            using (SqlConnection myConnection = new SqlConnection(sqlDataSource))
            {
                myConnection.Open();
                using (SqlCommand myCommand = new SqlCommand(query, myConnection))
                {
                    myCommand.Parameters.AddWithValue("@AppointmentID", appointment.AppointmentID);
                    myCommand.Parameters.AddWithValue("@AppointmentFIO", appointment.AppointmentFIO);
                    myCommand.Parameters.AddWithValue("@AppointmentEmail", appointment.AppointmentEmail);
                    myCommand.Parameters.AddWithValue("@ServiceID", appointment.ServiceID);
                    myCommand.Parameters.AddWithValue("@DoctorID", appointment.DoctorID);
                    myCommand.Parameters.AddWithValue("@AppointmentDate", appointment.AppointmentDate);
                    myCommand.Parameters.AddWithValue("@AppointmentTime", appointment.AppointmentTime);
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
            var query = @"DELETE FROM Appointment WHERE AppointmentID=@AppointmentID";
            DataTable table = new DataTable();
            var sqlDataSource = _configuration.GetConnectionString("PetsDBCon");
            using (SqlConnection myConnection = new SqlConnection(sqlDataSource))
            {
                myConnection.Open();
                using (SqlCommand myCommand = new SqlCommand(query, myConnection))
                {
                    myCommand.Parameters.AddWithValue("@AppointmentID", id);
                    var sqlDataReader = myCommand.ExecuteReader();
                    table.Load(sqlDataReader);
                    sqlDataReader.Close();
                }
            }

            return new JsonResult("Успешно удалено!");
        }
    }
}
