<?php

    final class Model_Main extends Model
    {
        public function get_data()
        {
            $sql = 'SELECT * FROM user';
            $result = $this->connection->query($sql);

            if ( $result->rowCount() > 0 )
            {
                $data = [];
                while ( $row = $result->fetch(PDO::FETCH_ASSOC) )
                {
                    $data[] = $row;
                }
                return $data;
            }
            return [];
        }

        public function put_data($data)
        {
            if ( !empty($data) && is_array($data) )
            {
                extract($data);
                $statement = $this->connection->prepare('INSERT INTO user (name, age, email, phone, gender) VALUES (:name, :age, :email, :phone, :gender)');
                
                $statement->bindParam(':name', $name);
                $statement->bindParam(':age', $age);
                $statement->bindParam(':email', $email);
                $statement->bindParam(':phone', $phone);
                $statement->bindParam('gender', $gender);
                
                if ( $statement->execute() )
                {
                    return true;
                }
            }
            
            return false;

        }
    }

?>