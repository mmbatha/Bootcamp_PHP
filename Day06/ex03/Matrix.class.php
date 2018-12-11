<?php
// require_once("Vector.class.php");
    class Matrix
    {
        const IDENTITY = "IDENTITY";
        const SCALE = "SCALE";
        const RX = "Ox ROTATION";
        const RY = "Oy ROTATION";
        const RZ = "Oz ROTATION";
        const TRANSLATION = "TRANSLATION";
        const PROJECTION = "PROJECTION";

        protected $matrix = array();
        private $_preset;
        private $_scale;
        private $_angle;
        private $_vtc;
        private $_fov;
        private $_ratio;
        private $_near;
        private $_far;
        public static $verbose = FALSE;

        public function __construct(array $kwargs)
        {
            if (isset($kwargs)) {
                if (isset($kwargs['preset']))
                    $this->_preset = $kwargs['preset'];
                if (isset($kwargs['scale']))
                    $this->_scale = $kwargs['scale'];
                if (isset($kwargs['angle']))
                    $this->_angle = $kwargs['angle'];
                if (isset($kwargs['vtc']))
                    $this->_vtc = $kwargs['vtc'];
                if (isset($kwargs['fov']))
                    $this->_fov = $kwargs['fov'];
                if (isset($kwargs['ratio']))
                    $this->_ratio = $kwargs['ratio'];
                if (isset($kwargs['near']))
                    $this->_near = $kwargs['near'];
                if (isset($kwargs['far']))
                    $this->_far = $kwargs['far'];
                $this->_check();
                $this->_calcMatrix();
                if (Self::$verbose) {
                    if ($this->_preset == self::IDENTITY)
                        echo "Matrix " . $this->_preset . " instance constructed\n";
                    else
                        echo "Matrix " . $this->_preset . " preset instance constructed\n";
                }
                $this->_dispatch();
            }
        }

        private function _dispatch()
        {
            switch ($this->_preset) {
                case (self::IDENTITY) :
                    $this->_identity(1);
                    break;
                case (self::TRANSLATION) :
                    $this->_translation();
                    break;
                case (self::SCALE) :
                    $this->_identity($this->_scale);
                    break;
                case (self::RX) :
                    $this->_rotationX();
                    break;
                case (self::RY) :
                    $this->_rotationY();
                    break;
                case (self::RZ) :
                    $this->_rotationZ();
                    break;
                case (self::PROJECTION) :
                    $this->_projection();
                    break;
            }
        }

        private function _calcMatrix()
        {
            for ($i = 0; $i < 16; $i++) {
                $this->matrix[$i] = 0;
            }
        }

        private function _identity($scale)
        {
            $this->matrix[0] = $scale;
            $this->matrix[5] = $scale;
            $this->matrix[10] = $scale;
            $this->matrix[15] = 1;
        }

        private function _translation()
        {
            $this->_identity(1);
            $this->matrix[3] = $this->_vtc->getX();
            $this->matrix[7] = $this->_vtc->getY();
            $this->matrix[11] = $this->_vtc->getZ();
        }

        private function _rotationX()
        {
            $this->_identity(1);
            $this->matrix[0] = 1;
            $this->matrix[5] = cos($this->_angle);
            $this->matrix[6] = -sin($this->_angle);
            $this->matrix[9] = sin($this->_angle);
            $this->matrix[10] = cos($this->_angle);
        }

        private function _rotationY()
        {
            $this->_identity(1);
            $this->matrix[0] = cos($this->_angle);
            $this->matrix[2] = sin($this->_angle);
            $this->matrix[5] = 1;
            $this->matrix[8] = -sin($this->_angle);
            $this->matrix[10] = cos($this->_angle);
        }

        private function _rotationZ()
        {
            $this->_identity(1);
            $this->matrix[0] = cos($this->_angle);
            $this->matrix[1] = -sin($this->_angle);
            $this->matrix[4] = sin($this->_angle);
            $this->matrix[5] = cos($this->_angle);
            $this->matrix[10] = 1;
        }

        private function _projection()
        {
            $this->_identity(1);
            $this->matrix[5] = 1 / tan(0.5 * deg2rad($this->_fov));
            $this->matrix[0] = $this->matrix[5] / $this->_ratio;
            $this->matrix[10] = -1 * (-$this->_near - $this->_far) / ($this->_near - $this->_far);
            $this->matrix[14] = -1;
            $this->matrix[11] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);
            $this->matrix[15] = 0;
        }

        private function _check()
        {
            if (empty($this->_preset))
                return "error";
            if ($this->_preset == self::SCALE && empty($this->_scale))
                return "error";
            if (($this->_preset == self::RX || $this->_preset == self::RY || $this->_preset == self::RZ) && empty($this->_angle))
                return "error";
            if ($this->_preset == self::TRANSLATION && empty($this->_vtc))
                return "error";
            if ($this->_preset == self::PROJECTION && (empty($this->_fov) || empty($this->_radio) || empty($this->_near) || empty($this->_far)))
                return "error";
        }

        public function mult(Matrix $rhs)
        {
            $arr = array();
            for ($i = 0; $i < 16; $i += 4) {
                for ($j = 0; $j < 4; $j++) {
                    $arr[$i + $j] = 0;
                    $arr[$i + $j] += $this->matrix[$i + 0] * $rhs->matrix[$j + 0];
                    $arr[$i + $j] += $this->matrix[$i + 1] * $rhs->matrix[$j + 4];
                    $arr[$i + $j] += $this->matrix[$i + 2] * $rhs->matrix[$j + 8];
                    $arr[$i + $j] += $this->matrix[$i + 3] * $rhs->matrix[$j + 12];
                }
            }
            $matrice = new Matrix($arr);
            $matrice->matrix = $arr;
            return $matrice;
        }

        public function transformVertex(Vertex $vtx)
        {
            $arr = array();
            $arr['x'] = ($vtx->getX() * $this->matrix[0]) + ($vtx->getY() * $this->matrix[1]) + ($vtx->getZ() * $this->matrix[2]) + ($vtx->getW() * $this->matrix[3]);
            $arr['y'] = ($vtx->getX() * $this->matrix[4]) + ($vtx->getY() * $this->matrix[5]) + ($vtx->getZ() * $this->matrix[6]) + ($vtx->getW() * $this->matrix[7]);
            $arr['z'] = ($vtx->getX() * $this->matrix[8]) + ($vtx->getY() * $this->matrix[9]) + ($vtx->getZ() * $this->matrix[10]) + ($vtx->getW() * $this->matrix[11]);
            $arr['w'] = ($vtx->getX() * $this->matrix[11]) + ($vtx->getY() * $this->matrix[13]) + ($vtx->getZ() * $this->matrix[14]) + ($vtx->getW() * $this->matrix[15]);
            $arr['color'] = $vtx->getColor();
            $vertex = new Vertex($arr);
            return $vertex;
        }

        public function __destruct()
        {
            if (self::$verbose)
				printf("Matrix instance destructed\n");
			return;
        }

        public function __toString()
        {
            $arr = "M | vtcX | vtcY | vtcZ | vtxO\n";
            $arr .= "-----------------------------\n";
            $arr .= "x | %0.2f | %0.2f | %0.2f | %0.2f\n";
            $arr .= "y | %0.2f | %0.2f | %0.2f | %0.2f\n";
            $arr .= "z | %0.2f | %0.2f | %0.2f | %0.2f\n";
            $arr .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
            return (vsprintf($arr, array($this->matrix[0], $this->matrix[1], $this->matrix[2], $this->matrix[3], $this->matrix[4], $this->matrix[5], $this->matrix[6], $this->matrix[7], $this->matrix[8], $this->matrix[9], $this->matrix[10], $this->matrix[11], $this->matrix[12], $this->matrix[13], $this->matrix[14], $this->matrix[15])));
        }

        public function doc()
        {
			return file_get_contents("Matrix.doc.txt");
        }
    }
?>