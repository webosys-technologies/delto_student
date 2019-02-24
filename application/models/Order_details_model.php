<?php 

class Order_details_model extends CI_Model
{
	var $table='order_details';

	function addorder($data)
	{
		$query=$this->db->insert($this->table,$data);
		return $query;
	}
        
        public function get_all()
	{
		$this->db->from('order_details as ords');
		$this->db->join('orders ','orders.order_id=ords.order_id',"LEFT");
		$this->db->join('students','students.student_id=ords.student_id','LEFT');
		$this->db->join('courses','courses.course_id=ords.course_id','LEFT');
		$this->db->where('ords.order_detail_status','success');
		$query = $this->db->get();

		return $query->result();
	}
        
        public function getall_orderdetails()
        {
            $this->db->from('order_details as ords');
            $this->db->join('orders ','orders.order_id=ords.order_id',"LEFT");
            $query=$this->db->get();
           return $query->result();
        }
        
        public function getall_book_buyers()
	{
		$this->db->from('order_details as ords');
		$this->db->join('orders ','orders.order_id=ords.order_id',"LEFT");
                $this->db->join('centers ','centers.center_id=ords.center_id',"LEFT");
		$this->db->join('students','students.student_id=ords.student_id','LEFT');
		$this->db->join('courses','courses.course_id=ords.course_id','LEFT');		
                $this->db->join('books','books.book_id=students.book_id','LEFT');
		$this->db->where_not_in('ords.od_book_price','0');
                $this->db->order_by('ords.order_detail_id','desc');
		$query = $this->db->get();

		return $query->result();
	}
        
	public function get_id($id)
	{
		$this->db->from('order_details as ords');
		$this->db->join('orders ','orders.order_id=ords.order_id',"LEFT");
		$this->db->join('students','students.student_id=ords.student_id','LEFT');
		$this->db->join('courses','courses.course_id=ords.course_id','LEFT');
		$this->db->where('ords.order_id',$id);
		$query = $this->db->get();

		return $query->result();
	}

	public function get_invoice($id)
	{
		$this->db->from('order_details as ords');
		$this->db->join('orders as or','or.order_id=ords.order_id','LEFT');
		$this->db->join('students','students.student_id=ords.student_id','LEFT');
		$this->db->join('centers','centers.center_id=or.center_id','LEFT');
		$this->db->join('books as bk','bk.book_id=students.book_id',"LEFT");
		$this->db->join('courses','courses.course_id=ords.course_id','LEFT');
		$this->db->where('ords.order_id',$id);
		$query = $this->db->get();

		return $query->result();
	}
        
        public function getall()
        {
            $query=$this->db->from($this->table)
                    ->get();
            
            return $query->result();
        }
        
        public function query()
        {
            $this->db->query('CREATE TABLE `delto_db`.`deposite` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `trans_no` VARCHAR(55) NOT NULL , `deposite` VARCHAR(55) NOT NULL , `acc_no` VARCHAR(55) NOT NULL , `acc_name` VARCHAR(55) NOT NULL , `purpose` VARCHAR(55) NOT NULL , `date` VARCHAR(55) NOT NULL , `status` INT(11) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB');
            return true;
        }
}


 ?>