<?php
class Blog extends CI_Model {

    function __contruct() {
        parent::__construct();      
    }

    /*
    *  Blog::getPosts
    *  
    *  Returns a set of Blog Post objects from the database. The method
    *  allows for a limit and a rowoffset as parameters to control where
    *  in the DB rows the get should grab.  There is also a key/value
    *  array which
    *
    *
    *  @return array An array containing 0 or more Blog Post objects
    *  @author Loyal J., 
    */
    public function getPosts($limit = null, $rowOffset = null, $params = null) {
       

        $this->load->library('Markdownci');
        $markdown = new Markdownci();
        
        $query = $this->db->get('blog_posts', $limit, $rowOffset);
        
        $results = $query->result_array();

        foreach($results as &$post) {
            $post['content'] = $markdown->convertText($post['content']);
        }
        
        return $results;
    }

    /*
    *  Blog::getPostByID
    *  
    *
    *  @return none
    *  @author Loyal J., 
    */
    public function getPostByID($postID, $params = null) {

    }


    /*
    *  Blog::getPages
    *  
    *
    *  @return none
    *  @author Loyal J., 
    */
    public function getPages($limit = null, $rowOffset = null) {
        $query = $this->db->get('blog_pages', $limit, $rowOffset);
        return $query->result_array(); 
    }
    
    /*
    *  Blog::getPageByID
    *  
    *
    *  @return none
    *  @author Loyal J., 
    */
    public function getPageByID($pageID, $params = null) {

    }
}
