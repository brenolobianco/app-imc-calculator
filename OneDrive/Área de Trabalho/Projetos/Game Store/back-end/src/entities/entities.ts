
import {
  Entity,
  PrimaryGeneratedColumn,
  Column,
  CreateDateColumn,
 
} from "typeorm";

@Entity("games")
class Games {
  @PrimaryGeneratedColumn("uuid")
  id: string;

  @Column()
  name: string;


  @Column()
  img: string;

  @Column()
  console: string;

  @Column()
  price: string;

  @Column()
  category: string;

  @CreateDateColumn({ type: "date" })
  createdAt: Date;
}

export { Games };
