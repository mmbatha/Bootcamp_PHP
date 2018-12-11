<?php
    class Camera
    {
        private $_proj;
        private $_tR;
        private $_tT;
        private $_origine;
        private $_width;
        private $_height;
        private $_ratio;
        public static $verbose = false;

        public function __construct(array $kwargs)
        {
            $this->_origine = $kwargs['origin'];
            $this->_tT = new Matrix(array('preset' => Matrix::TRANSLATION, 'vtc' => $this->_origine->opposite()));
            $this->_tR = $this->_transpose($kwargs['orientation']);
            $this->_width = (float)$kwargs['width'] / 2;
            $this->_height = (float)$kwargs['height'] / 2;
            $this->_ratio = $this->_width / $this->_height;
            $this->_proj = new Matrix(array(
                'preset' => Matrix::PROJECTION,
                'fov' => $kwargs['fov'],
                'ratio' => $this->_ratio,
                'near' => $kwargs['near'],
                'far' => $kwargs['far']
            ));
            if (self::$verbose) {
                echo "Camera instance constructed\n";
            }
        }

        public function watchVertex(Vertex $wrldVtx){
            $vtx = $this->_proj->transformVertex($this->_tR->transformVertex($wrldVtx));
            $vtx->setX($vtx->getX() * $this->_ratio);
            $vtx->setY($vtx->getY());
            $vtx->setColor($wrldVtx->getColor());
            return ($vtx);
        }

        private function _transpose(Matrix $m){
            $arr[0] = $m->matrix[0];
            $arr[1] = $m->matrix[4];
            $arr[2] = $m->matrix[8];
            $arr[3] = $m->matrix[12];
            $arr[4] = $m->matrix[1];
            $arr[5] = $m->matrix[5];
            $arr[6] = $m->matrix[9];
            $arr[7] = $m->matrix[13];
            $arr[8] = $m->matrix[2];
            $arr[9] = $m->matrix[6];
            $arr[10] = $m->matrix[10];
            $arr[11] = $m->matrix[14];
            $arr[12] = $m->matrix[3];
            $arr[13] = $m->matrix[7];
            $arr[14] = $m->matrix[11];
            $arr[15] = $m->matrix[15];
            $m->matrix = $arr;
            return ($m);
        }

        public function __destruct()
        {
            if (self::$verbose)
				printf("Camera instance destructed\n");
			return;
        }

        public function __toString()
        {
            $arr = "Camera( \n";
            $arr .= "+ Origine: ".$this->_origine."\n";
            $arr .= "+ tT:\n".$this->_tT."\n";
            $arr .= "+ tR:\n".$this->_tR."\n";
            $arr .= "+ tR->mult( tT ):\n".$this->_tR->mult($this->_tT)."\n";
            $arr .= "+ Proj:\n".$this->_proj."\n)";
            return ($arr);
        }

        public function doc()
        {
			return file_get_contents("Camera.doc.txt");
        }
    }
?>