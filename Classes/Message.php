<?php


class Message
{
    public function viewMessages($dbcon, $msgSort)
    {
        //select all messages
        $sql = 'SELECT m.id, m.subject, m.body, DATE_FORMAT(m.date, "%M %d, %Y") AS m_date, topics.name, topics.id AS topic_id FROM messages m 
                JOIN topics ON m.topic_id = topics.id' . $msgSort . ' ORDER BY m.date DESC';
        //$sql = 'SELECT * FROM messages';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $message = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $message;
    }

    public function viewTopics($dbcon)
    {
        //select all messages
        $sql = 'SELECT * FROM topics';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $topics = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $topics;
    }


    public function addMessage($dbcon, $subject, $msg, $topic)
    {
        //insert data
        $sql = 'INSERT INTO messages (subject, body, date, topic_id) VALUES (:subject, :msg, CURDATE(), :topic)';
        $pdostm = $dbcon->prepare($sql);

        //$pst->bindParam(':id', $id);
        $pdostm->bindParam(':subject', $subject);
        $pdostm->bindParam(':msg', $msg);
        $pdostm->bindParam(':topic', $topic);

        $count = $pdostm->execute();
        return $count;

    }

    public function updateMessage($dbcon, $id, $subject, $msg, $topic)
    {
        //SQL Query
        $sql = 'UPDATE messages SET subject = :subject, body = :msg, topic_id = :topic WHERE id = :id';
        $pdostm = $dbcon->prepare($sql);
        //bind variables
        $pdostm->bindParam(':id', $id);
        $pdostm->bindParam(':subject', $subject);
        $pdostm->bindParam(':msg', $msg);
        $pdostm->bindParam(':topic', $topic);
        $count = $pdostm->execute();
        return $count;
    }

    public function deleteMessage($id, $dbcon)
    {
        $sql = 'DELETE FROM messages WHERE id = :id';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':id', $id);
        $count = $pdostm->execute();
        return $count;
    }

    public function getMsgByID($dbcon, $id)
    {
        $sql = 'SELECT messages.id, subject, body, topics.name, topics.id AS topic_id FROM messages JOIN topics ON messages.topic_id = topics.id WHERE messages.id = :id';
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(PDO::FETCH_OBJ);
    }

    public function sortMessages($dbcon, $topic)
    {
        //select messages by topic
        $sql = 'SELECT messages.id, subject, body, topics.name, topics.id AS topic_id FROM messages JOIN topics ON messages.topic_id = topics.id WHERE topics.id = :topicid';
        //$sql = 'SELECT * FROM messages';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':topicid', $topic);
        $pdostm->execute();

        $message = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $message;
    }
}