<?php

namespace app\models\client;

/**
 * This is the ActiveQuery class for [[Staff]].
 *
 * @see Staff
 */
class StaffQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Staff[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Staff|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
