using Microsoft.AspNetCore.Mvc;
using System.Data;
using api.Models;
using Microsoft.Data.SqlClient;

namespace api.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class ServicesController : ControllerBase
    {
        private readonly IConfiguration _configuration;
        
        public ServicesController(IConfiguration configuration)
        {
            _configuration = configuration;
        }

        [HttpGet]
        public JsonResult Get()
        {
            var query = @"SELECT ServiceID, ServicePrice, ServiceName FROM Services";
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
        public JsonResult Post(Services services)
        {
            var query = @"INSERT INTO Services VALUES (@ServicePrice, @ServiceName)";
            DataTable table = new DataTable();
            var sqlDataSource = _configuration.GetConnectionString("PetsDBCon");
            using (SqlConnection myConnection = new SqlConnection(sqlDataSource))
            {
                myConnection.Open();
                using (SqlCommand myCommand = new SqlCommand(query, myConnection))
                {
                    myCommand.Parameters.AddWithValue("@ServicePrice", services.ServicePrice);
                    myCommand.Parameters.AddWithValue("@ServiceName", services.ServiceName);
                    var sqlDataReader = myCommand.ExecuteReader();
                    table.Load(sqlDataReader);
                    sqlDataReader.Close();
                }
            }

            return new JsonResult("Успешно добавлено!");
        }

        [HttpPut]
        public JsonResult Put(Services services)
        {
            var query = @"UPDATE Services SET ServicePrice=@ServicePrice, ServiceName=@ServiceName WHERE ServiceID=@ServiceID";
            DataTable table = new DataTable();
            var sqlDataSource = _configuration.GetConnectionString("PetsDBCon");
            using (SqlConnection myConnection = new SqlConnection(sqlDataSource))
            {
                myConnection.Open();
                using (SqlCommand myCommand = new SqlCommand(query, myConnection))
                {
                    myCommand.Parameters.AddWithValue("@ServiceID", services.ServiceID);
                    myCommand.Parameters.AddWithValue("@ServicePrice", services.ServicePrice);
                    myCommand.Parameters.AddWithValue("@ServiceName", services.ServiceName);
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
            var query = @"DELETE FROM Services WHERE ServiceID=@ServiceID";
            DataTable table = new DataTable();
            var sqlDataSource = _configuration.GetConnectionString("PetsDBCon");
            using (SqlConnection myConnection = new SqlConnection(sqlDataSource))
            {
                myConnection.Open();
                using (SqlCommand myCommand = new SqlCommand(query, myConnection))
                {
                    myCommand.Parameters.AddWithValue("@ServiceID", id);
                    var sqlDataReader = myCommand.ExecuteReader();
                    table.Load(sqlDataReader);
                    sqlDataReader.Close();
                }
            }

            return new JsonResult("Успешно удалено!");
        }
    }
}