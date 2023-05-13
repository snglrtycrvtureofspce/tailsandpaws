namespace api.Models
{
    public class Appointment
    {
        public int AppointmentID { get; set; }
        public string AppointmentFIO { get; set; }
        public string AppointmentEmail { get; set; }
        public int ServiceID { get; set; }
        public int DoctorID { get; set; }
        public DateOnly AppointmentDate { get; set; }
        public TimeOnly AppointmentTime { get; set; }
    }
}
