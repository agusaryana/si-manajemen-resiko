// application/controllers/Event.php

class Event extends CI_Controller {

public function input_event() {
// Tangani logika penyimpanan data kejadian
$data = array(
'description' => $this->input->post('description'),
'date' => $this->input->post('date'),
'location' => $this->input->post('location'),
'approval_level' => $this->input->post('approval_level'),
'status' => 'pending'
);

// Panggil model untuk menyimpan data kejadian ke dalam database
$this->load->model('Event_model');
$this->Event_model->save_event($data);

// Redirect atau tampilkan pesan sukses
redirect('event/input_success');
}

public function view_approval_events($level) {
// Panggil model untuk mendapatkan daftar kejadian yang memerlukan persetujuan pada level tertentu
$this->load->model('Event_model');
$data['events'] = $this->Event_model->get_events_for_approval($level);

// Tampilkan daftar kejadian dalam tampilan
$this->load->view('approval_events', $data);
}

public function approve_event($event_id, $approval_status) {
// Panggil model untuk memperbarui status kejadian
$this->load->model('Event_model');
$this->Event_model->update_event_status($event_id, $approval_status);

// Tampilkan notifikasi atau pesan sukses/gagal
$this->load->view('approval_result');
}
}