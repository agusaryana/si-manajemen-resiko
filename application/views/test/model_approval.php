// application/models/Event_model.php

class Event_model extends CI_Model {

public function save_event($data) {
// Simpan data kejadian ke dalam database
$this->db->insert('events', $data);
}

public function get_events_for_approval($level) {
// Ambil data kejadian yang memerlukan persetujuan pada level tertentu
$this->db->where('approval_level', $level);
$this->db->where('status', 'pending');
return $this->db->get('events')->result_array();
}

public function update_event_status($event_id, $new_status) {
// Perbarui status kejadian di database
$this->db->where('id', $event_id);
$this->db->update('events', array('status' => $new_status));
}
}