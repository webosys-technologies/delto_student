<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam_details_model extends CI_Model
{

	var $table = 'exam_details';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
        
        
        public function insert_data($data,$id)
	{
            
           
         $exam_detail=array('exam_id'=>$id,
             'student_id'=>$data['student_id'],
             'question_id'=>$data['question_id'],
             'correct_ans'=>$data['correct_ans'],
             'given_ans'=>$data['given_ans'],
             'mark'=>$data['mark'],
             'exam_detail_status'=>'1'); 
         
	$query=$this->db->insert($this->table,$exam_detail);
		//return $query->row();
	}
        
        function test_review($data)
        {
               $this->db->from('exam_details as exm');        

         $this->db->join('questions as que', 'que.question_id=exm.question_id', 'LEFT');
            $this->db->where('exm.exam_id',$data['exam_id']);
            $query = $this->db->get();

            return $query->result();
            
        }
         
        public function get_all_result($id)
        {
            $this->db->from($this->table);
            $this->db->where('student_id',$id);
            $query=$this->db->get();
            
            return $query->result();
        }
        
         public function get_result_by_id($id,$exam_id)
	{
		$this->db->from($this->table);
		$this->db->where(array('student_id'=>$id,
                                       'exam_id'=>$exam_id));
		$query = $this->db->get();
                 //$this->get
		$total_questions=$query->num_rows();
                $marks=$query->result();
                $total_mark=0;
                $correct_ans=0;
                $wrong_ans=0;
               foreach($marks as $res)
               {
                   if($res->mark>0)
                   {
                   $correct_ans=$correct_ans+1;
                   }
                   else
                   {
                     $wrong_ans=$wrong_ans+1;  
                   }
                   $total_mark=$total_mark+$res->mark;
               }
               
               
               $exam_result=array('total_questions'=>$total_questions,
                                  'total_marks'=>$total_mark,
                                  'correct_ans'=>$correct_ans,
                                  'wrong_ans'=>$wrong_ans,
                                  );
              
               return $exam_result;

	}
        
        
}