<?php

namespace app\models\client;

/**
 * This is the ActiveQuery class for [[Client]].
 *
 * @see Client
 */
class ClientQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/


//    public $type;
//
//    public function prepare($builder)
//    {
//        if ($this->type !== null) {
//            $this->andWhere(['type' => $this->type]);
//        }
//        return parent::prepare($builder);
//    }
//




    /**
     * {@inheritdoc}
     * @return Client[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Client|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
