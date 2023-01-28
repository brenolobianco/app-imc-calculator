
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

  @Column({ default: true })
  isActive: boolean;

  @CreateDateColumn({ type: "date" })
  createdAt: Date;
}

export { Games };
